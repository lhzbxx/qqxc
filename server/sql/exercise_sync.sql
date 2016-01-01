use qqxc;

CREATE TABLE exercise_sync (
	id int primary key auto_increment,
    user_id int not null unique,
    wrong_collect text,
    star_collect text,
    exam_record text,
    history text,
    last_sync_time int(32) not null
);