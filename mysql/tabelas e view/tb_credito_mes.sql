create table tb_credito_mes
(
   id_compra int primary key auto_increment,
   valor float(7,2)not null,
   descricao varchar(50)not null,
   data date not null,
   login varchar(10) not null
);

alter table tb_credito_mes add constraint fk_loginc foreign key(login) references tb_usuario(login);