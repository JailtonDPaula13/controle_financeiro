create table tb_despesas(
	id_despesa  int primary key auto_increment,
    valor       double(9,2),
    despesas    varchar(50) not null,
    local       varchar(50),
    data        date,
    tipo        int,
    obs         varchar(1000),
    dt_registro timestamp
);