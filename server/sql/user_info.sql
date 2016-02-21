use qqxc;

drop table user_info;

CREATE TABLE user_info (
	  id int primary key auto_increment,
    user_id int,
    gender char(1) COMMENT '性别, F/M/N' DEFAULT 'N',
    nickname varchar(32) COMMENT '学员昵称',
    phone varchar(32) COMMENT '学员手机号' unique,
    contact varchar(32) COMMENT '联系方式',
    contact_back varchar(32) COMMENT '备用联系方式',
    register_time int not null COMMENT '注册时间',
    avatar varchar(128) COMMENT '头像' default '',
    process tinyint not null COMMENT '完成进度' default 0,
    city VARCHAR(10) COMMENT '城市',
    lat float COMMENT '经度' DEFAULT 0,
    lng FLOAT COMMENT '纬度' DEFAULT 0,
    user_state char(1) COMMENT '账号状态, N 正常, S 停用' not null default 'N',
    wx_openid varchar(32) COMMENT '微信平台Openid' UNIQUE
);