use qqxc;

drop table log;

CREATE TABLE log (
	  id int primary key auto_increment,
    IP_addr varchar(32) not null COMMENT '请求IP地址',
    platform varchar(10) not null COMMENT '请求平台',
    action varchar(32) not null COMMENT '请求操作',
#     content varchar(32) not null COMMENT '实际内容',
    elapsed_time int (5) not null COMMENT '耗费时长',
#     remark text COMMENT '备注',
    level tinyint not null default 0 COMMENT '请求级别',
    create_time int(32) not null
);