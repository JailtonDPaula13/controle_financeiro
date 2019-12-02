create view vw_valor_d
as
select
truncate((
select
	(
	 select sum(c.valor)	from tb_credito_mes c
	)
	-
	(
	 select sum(d.valor)	from tb_despesa_mes d
	)
	as "RESTO"
)
/
(
 select	date_format(last_day(now()),'%d') - date_format(now(),'%D')+1 as "tempo"
),2)
as "retorno"