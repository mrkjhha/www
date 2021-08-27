create table user_gallery (
   num int not null auto_increment,
   id char(15) not null,
   name  char(10) not null,
   nick  char(10) not null,
   subject char(100) not null,
   content text not null,
   tag char(100) not null,
   blog char(100) not null,
   instar char(100) not null,
   regist_day char(20),
   file_name char(40),
   file_copied char(30),
   primary key(num)
);