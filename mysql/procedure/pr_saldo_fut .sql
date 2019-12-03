delimiter !$

CREATE  PROCEDURE pr_saldo_fut (v_valor float(7,2), v_descricao varchar(50), v_datem varchar(2), v_datea varchar(4))
begin
    declare v_concat date;
    set v_concat := concat(v_datea,'-',v_datem,'-',01);
	if v_valor != 0
    then
		insert into tb_saldo_fut values(null,v_valor,v_descricao,v_concat);
    end if;
end!$

delimiter ;