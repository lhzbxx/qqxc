use qqxc;

create table block (
	id int primary key auto_increment,001
	block int unique comment '地区编码，参考邮政编码。',
	block_name varchar(10) comment '地区名称',
	parent_id int default 0，
	price varchar(10) comment '地区价格'
)