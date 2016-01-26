use qqxc;

drop table coupon;

CREATE TABLE coupon(
	id int primary key auto_increment,
    user_id int not null,
    coupon_type char(1) COMMENT '优惠码类型, 默认为N' not null default 'N',
    coupon_code varchar(32) not null,
    discount varchar(10) COMMENT '折扣金额' not null,
    state char(1) COMMENT '状态, N 正常, S 停用' not null default 'N',
    create_time int(32) not null
);