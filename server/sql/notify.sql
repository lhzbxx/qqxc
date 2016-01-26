use qqxc;

drop table notify;

create table notify (
	  id int primary key auto_increment,
    cid int not null,
  	type char(1) comment '用户类型，C 教练，U 用户，A 管理员',
    content text not null COMMENT '通知内容',
    sender varchar(20) not null comment '发送方' default 'system',
    source_type varchar(32) comment '预留字段，区分特殊格式。',
    state char(1) not null comment '状态，Y 已读，N 未读，D 删除' default 'N',
    create_time int(32) not null comment '发送时间'
)