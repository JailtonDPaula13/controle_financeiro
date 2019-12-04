create view vw_consulta_saldo_f
as
select
(select
sum(valor)
from
tb_saldo_fut
where date_format(data, '%y%m') =
date_format(date_add(now(), interval 1 month),'%y%m'))
-
(select
sum(valor)
from
tb_despesa_fut
where date_format(mes, '%y%m') =
date_format(date_add(now(), interval 1 month),'%y%m'))
as "resultado";