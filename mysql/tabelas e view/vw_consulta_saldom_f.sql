create view vw_consulta_saldom_f
as
select
truncate(((select
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
date_format(date_add(now(), interval 1 month),'%y%m')))
/
(
select
date_format(LAST_DAY(now()), '%d')+1 - date_format(now(), '%D')),2)
as "resultado";
