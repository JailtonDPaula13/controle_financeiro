delimiter !$

create function fn_saldo_futuro_dia( v_mes int(1), v_login varchar(10)) returns float(7,2)
begin
   declare v_mes_um float(7,2);
   select
   ((select sum(valor) from tb_saldo_fut
   where
   login = v_login and
   date_format(data, '%y%m') = date_format(date_add(now(), interval v_mes month),'%y%m'))
   -
   (select sum(valor) from tb_despesa_fut
   where
   login = v_login and
   date_format(mes, '%y%m') = date_format(date_add(now(), interval v_mes month),'%y%m')))
   /
   (select date_format(last_day(date_add(now(), interval v_mes month)),'%d'))
   into v_mes_um;
   
   return v_mes_um;
end !$

delimiter ;