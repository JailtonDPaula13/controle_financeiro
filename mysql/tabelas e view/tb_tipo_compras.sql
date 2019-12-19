create table tb_tipo_compras
(
	id_tipo int primary key auto_increment,
    ds_tipo varchar(20)
)
;

insert into tb_tipo_compras values (null, 'COMIDA'),(null, 'TRANSPORTE'),(null,'LAZER'),(null,'PROFISSIONAL'),(null,'OUTROS');