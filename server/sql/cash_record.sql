use qqxc;

drop table cash_record;

CREATE TABLE cash_record (
  id int PRIMARY KEY AUTO_INCREMENT,
  card_id int,
  description VARCHAR(128) COMMENT '流水描述',
  serial VARCHAR(32) COMMENT '流水号, 方便查询.',
  type char(1) COMMENT '收支类型, A +, M -',
  amount varchar(10) COMMENT '金额',
  state char(1) COMMENT '状态, N 初始状态, S 成功, F 失败' DEFAULT 'N',
  create_time int COMMENT '操作时间'
)