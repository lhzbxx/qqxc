use qqxc;

create table coach_price (
	id int primary key auto_increment,
	coach_id int not null,
	car_type char(2) not null,
	price varchar(10) not null
)