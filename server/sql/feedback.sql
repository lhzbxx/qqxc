use qqxc;

CREATE TABLE feedback (
	id int primary key auto_increment,
    phone varchar(32),
    content text,
    create_time timestamp not null
);