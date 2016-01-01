use qqxc;

CREATE TABLE exercise (
	id int primary key auto_increment,
    serial_number int not null unique,
    wrong_num int not null default 0,
    right_num int not null default 5
);