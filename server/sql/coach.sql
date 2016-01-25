use qqxc;

drop table coach;

create table coach (
    id int primary key auto_increment,
    username varchar(20) not null unique comment '用户名，一般为绑定手机。',
    pwd varchar(32) not null comment '密码',
    salt varchar(32) not null comment '加密盐'
)