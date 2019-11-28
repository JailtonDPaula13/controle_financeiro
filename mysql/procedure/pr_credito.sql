delimiter !$

create procedure pr_credito(v_valor float(7,2), v_descricao varchar(50), v_date date)
begin
	if v_valor != 0
    then
		insert into tb_credito_mes values(null,v_valor,v_descricao,v_date);
    end if;
end !$

delimiter ;