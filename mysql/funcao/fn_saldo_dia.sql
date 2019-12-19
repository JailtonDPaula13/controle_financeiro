delimiter !$

create function fn_saldo_dia(v_login varchar(10)) returns float(7,2)
begin

   declare v_retorno float(7,2);
   
   select
   ((select sum(c.valor) from tb_credito_mes c where login = v_login and date_format(c.data,'%y %m') = date_format(now(),'%y %m'))
   -
   (select sum(d.valor)	from tb_despesa_mes d where login = v_login and date_format(d.data,'%y %m') = date_format(now(),'%y %m')))
   /
   (select (date_format(last_day(now()),'%d')+1) - date_format(now(),'%d'))
   
   into v_retorno;
   
   return v_retorno;
end !$

delimiter ;