use qqxc;

CREATE TABLE feedback (
	id int primary key auto_increment,
    phone varchar(32),
    content text not null,
    create_time int(32) not null
);