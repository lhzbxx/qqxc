use qqxc;

drop table user_info;

CREATE TABLE user_info (
	  id int primary key auto_increment,
    user_id int not null,
    nickname varchar(32) COMMENT '学员昵称' not null,
    phone varchar(32) COMMENT '学员手机号' not null unique,
    contact varchar(32) COMMENT '联系方式',
    contact_back varchar(32) COMMENT '备用联系方式',
    register_time int not null COMMENT '注册时间',
    avatar varchar(128) COMMENT '头像' default '',
    process tinyint not null COMMENT '完成进度' default 0,
    user_state char(1) COMMENT '账号状态, N 正常, S 停用' not null default 'N'
);