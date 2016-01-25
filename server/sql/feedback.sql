use qqxc;

CREATE TABLE feedback (
	id int primary key auto_increment,
    contact varchar(32) comment '联系方式',
    content text not null comment '反馈内容',
    type char(1) comment 'C 教练，U 用户，A 管理员',
    create_time int(32) not null comment '反馈时间'
);