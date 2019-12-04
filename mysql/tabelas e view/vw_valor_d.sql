create view vw_valor_d
as
select
truncate((
select
	(
	 select sum(c.valor) from tb_credito_mes c where date_format(c.data,'%y %m') = date_format(now(),'%y %m')
	)
	-
	(
	 select sum(d.valor)	from tb_despesa_mes d where date_format(d.data,'%y %m') = date_format(now(),'%y %m')
	)
	as "RESTO"
)
/
(
 select	(date_format(last_day(now()),'%d')+1) - date_format(now(),'%d') as "tempo"
),2)
as "retorno"