create table tb_saldo_fut
(
   id_saldo_fut int primary key auto_increment,
   valor float(7,2)not null,
   descricao varchar(50)not null,
   data date not null,
   login varchar(10) not null
);

alter table tb_saldo_fut add constraint fk_login_sf foreign key(login) references tb_usuario(login);