use qqxc;

CREATE TABLE user_cash (
	id int primary key auto_increment,
    user_id int not null unique,
    amount float not null default 0.00,
    source varchar(20) not null,
    create_time int(32) not null
);