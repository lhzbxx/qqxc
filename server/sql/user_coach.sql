use qqxc;

drop table user_coach;

create table user_coach (
	-- 该表较为冗余, 因为某用户看过某个教练的消息可以直接写入notify表中.
	id int PRIMARY KEY AUTO_INCREMENT,
	user_id int not null,
	coach_id int not null,
	action char(1) not null COMMENT '操作, N 看过, S 关注...' DEFAULT 'N',
	create_time int not null
)