CREATE VIEW vw_valor_m
AS
SELECT 
 TRUNCATE(
   (SELECT 
       (SELECT SUM(c.valor) FROM tb_credito_mes c)
        -
       (SELECT SUM(d.valor) FROM tb_despesa_mes d)
    ),2) AS `retorno`;