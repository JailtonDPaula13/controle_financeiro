create table tb_despesa_mes
(
   id_compra int primary key auto_increment,
   valor float(7,2)not null,
   descricao varchar(50)not null,
   local varchar(50),
   data date not null
);