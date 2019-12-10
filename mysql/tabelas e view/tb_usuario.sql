create table tb_usuario
(
  id_loging int primary key auto_increment,
  login varchar(10) not null,
  senha varchar(6) not null,
  nome varchar(50) not null,
  email varchar(50)
);

alter table tb_usuario add constraint uq_login unique(login);