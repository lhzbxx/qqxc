use qqxc;

drop table user;

CREATE TABLE user (
	  id int primary key auto_increment,
	  account varchar(20) not null unique COMMENT '账号',
    pwd varchar(64) not NULL  COMMENT '密码',
#     account_type char(2) not null COMMENT '账号类型, WX 微信, PH 手机...' DEFAULT 'PH',
    salt varchar(32) not null COMMENT '加密盐'
);