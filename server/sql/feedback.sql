use qqxc;

drop TABLE feedback;

CREATE TABLE feedback (
	  id int primary key auto_increment,
    contact varchar(32) comment '联系方式',
    contact_type char(2) COMMENT 'QQ, WX, PH, MA',
    content text not null comment '反馈内容',
    type char(1) comment 'C 教练，U 用户，A 管理员',
    destination char(1) COMMENT 'C 教练, A 管理员',
    create_time int(32) not null comment '反馈时间'
);