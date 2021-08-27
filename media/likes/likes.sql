create table likes (
   num int not null auto_increment,
   parant int not null,
   id char(15) not null,
   name  char(10) not null,
   nick  char(10) not null,
   regist_day char(20),
   primary key(num)
);