delimiter !!

create procedure pr_add_despesas
(v_valor double(9,2), v_despesas varchar(50), v_local varchar(50), v_data date, v_tipo int, obs varchar(1000), v_qtd int)
begin
		while v_qtd > 0 do
			insert into tb_despesas values (null, v_valor, v_despesas, v_local, v_data, v_tipo, obs, now()); 
        end while;
end !!

delimiter ;