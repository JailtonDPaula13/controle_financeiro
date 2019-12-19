create table tb_despesa_fut
(
	id_des int primary key auto_increment,
    valor float(7,2),
    descricao varchar(30),
    mes date,
    login varchar(10) not null
);

alter table tb_despesa_fut add constraint fk_login_df foreign key(login) references tb_usuario(login);