use qqxc;

drop table card;

create TABLE card (
  id int PRIMARY KEY AUTO_INCREMENT,
  cid int not null,
  type char(1) comment '用户类型，C 教练，U 用户，A 管理员',
  name varchar(32) COMMENT '预留名称',
  serial varchar(32) NOT NULL COMMENT '预留账号',
  ctype char(2) not NULL COMMENT '卡的类型, C 信用卡, O 网络账号, S 储蓄卡...',
  organization VARCHAR(32) COMMENT '账户机构, 例如中国银行/支付宝/支行',
  `comment` varchar(128) COMMENT '备注',
  create_time int not null COMMENT '绑定时间'
)