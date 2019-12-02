create table tb_credito_mes
(
   id_compra int primary key auto_increment,
   valor float(7,2)not null,
   descricao varchar(50)not null,
   data date not null
);