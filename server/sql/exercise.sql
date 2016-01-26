use qqxc;

drop table exercise;

CREATE TABLE exercise (
  id int primary key auto_increment,
  serial_number int not null unique COMMENT '题目编号',
  wrong_num int not null default 0 COMMENT '正确数',
  right_num int not null default 5 COMMENT '错误数'
);