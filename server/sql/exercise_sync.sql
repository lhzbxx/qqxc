use qqxc;

DROP TABLE exercise_sync;

CREATE TABLE exercise_sync (
    id int primary key auto_increment,
    user_id int not null unique,
    wrong_collect text COMMENT '错题集',
    star_collect text COMMENT '收藏集',
    exam_record text COMMENT '考试记录',
    history text COMMENT '做题记录',
    last_sync_time int(32) not null COMMENT '上次同步时间'
);