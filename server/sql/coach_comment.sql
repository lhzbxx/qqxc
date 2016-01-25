use qqxc;

CREATE TABLE coach_comment (
	id int primary key auto_increment,
    user_id int not null,
    coach_id int not null,
    content text not null comment '评价内容',
    score int not null comment '评分',
    type char(2) not null comment '评价类型，C1/C2/PH...',
    complain_state char(1) comment '申诉状态，N 未申诉，T 申诉中，F 申诉完成。' default 'N',
    complain_result char(1) comment '申诉结果，F 申诉失败，S 申诉成功，N空。' default 'N',
    complain_reason varchar(128) comment '申诉原因',
    create_time int(32) not null
);