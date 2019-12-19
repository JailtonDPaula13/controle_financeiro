create table tb_despesa_mes
(
   id_compra int primary key auto_increment,
   valor float(7,2)not null,
   descricao varchar(50)not null,
   local varchar(50),
   data date not null,
   login varchar(10) not null,
   id_tipo int not null
);

alter table tb_despesa_mes add constraint fk_login foreign key(login) references tb_usuario(login);
alter table tb_despesa_mes add constraint fk_tipo foreign key(id_tipo) references tb_tipo_compras(id_tipo);