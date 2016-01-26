use qqxc;

drop table admin_info;

CREATE TABLE admin_info (
	  id int primary key auto_increment,
    admin_id int not null,
    nickname varchar(32) not null comment '昵称',
    avatar varchar(128) comment '头像' default '',
    auth tinyint not null comment '权限值' default 0,
    department char(1) not null comment '部门, R 超级管理员, M 市场, D 技术...',
    admin_state char(1) not null comment '账号状态，N 正常，S 停用...' default 'N',
    register_time int not null comment '注册时间'
);