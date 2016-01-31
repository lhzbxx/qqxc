use qqxc;

drop TABLE user_coupon;

create table user_coupon (
    id int primary key auto_increment,
    user_id int UNIQUE,
    coupon_id int
)