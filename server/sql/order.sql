USE qqxc;

DROP TABLE order;

CREATE TABLE `order` (
  id int primary key auto_increment,
  user_id int not null,
  coach_id int not null,
  state char(1) COMMENT '报名状态, N 未支付, Y 已支付' not null DEFAULT 'N',
  deal_type char(1) COMMENT '选择方式, N 学员选定, M 系统匹配...' default 'N',
  price VARCHAR(10) COMMENT '交易价格',
  pay_id VARCHAR(32) COMMENT '流水号' UNIQUE not null,
  car_type char(2) COMMENT '教车类型, C1/C2...' not null,
  `comment` varchar(128) COMMENT '备注, 给管理员看.',
  create_time int(32) not null
);