delimiter !$

create procedure pr_despesas_futura(v_valor float(7,2), v_descricao varchar(50), v_date_mes int(2), v_date_ano int(4), v_login varchar(10), v_tipo varchar(20))

begin
    declare v_concat date;
    set v_concat := concat(v_date_ano,'-',v_date_mes,'-',01);
	if v_valor != 0
    then
		insert into tb_despesa_fut values(null,v_valor,v_descricao,v_concat,v_login, v_tipo);
    end if;
end !$

delimiter ;