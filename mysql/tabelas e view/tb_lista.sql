create table tb_lista
(
   id_lista int primary key auto_increment,
   descricao varchar(50) not null,
   valor float(7,2)not null,
   status int(1) not null,
   data date not null default now(),
   comprado enum('S','N') not null default 'N',
   imagen varchar(100)
);

alter table tb_lista add constraint uq_prod unique(descricao);