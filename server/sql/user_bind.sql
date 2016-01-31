use qqxc;

drop TABLE user_bind;

create table user_bind (
    id int primary key auto_increment,
    user_id int UNIQUE,
    wx_openid varchar(32)
)