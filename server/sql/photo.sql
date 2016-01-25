use qqxc;

create table photo (
    id int primary key auto_increment,
    cid int not null,
    type char(1) comment '类型，C 教练，M 车照片，U 用户照片...',
    url varchar(128) comment '照片URL'
)