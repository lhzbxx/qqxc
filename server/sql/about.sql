use qqxc;

DROP TABLE about;

CREATE TABLE about (
  id int PRIMARY KEY AUTO_INCREMENT,
  version VARCHAR(32) COMMENT '版本号',
  content TEXT COMMENT '更新内容',
  service_phone varchar(32) COMMENT '客服电话',
  android_url varchar(128) COMMENT 'Android下载地址',
  ios_url varchar(128) COMMENT 'iOS下载地址',
  company_addr VARCHAR(32) COMMENT '公司地址',
  company_name VARCHAR(32) COMMENT '公司名称'
)