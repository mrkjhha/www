create table products (
   num int not null auto_increment,
   id char(15) not null,
   name  char(10) not null,
   nick  char(10) not null,
   product_name char(100) not null,
   content text not null,
   category char(20),
   sub_category char(20),
   size_x int,
   size_y int,
   regist_day char(20),
   file_name char(40),
   file_copied char(30),
   primary key(num)
);