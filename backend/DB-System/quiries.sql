create database Auth_subsystem ;
use Auth_subsystem ;

create table Users (
id int auto_increment ,
first_name varchar(14) not null,
surname varchar(14) not null,
email varchar(20)not null ,
birthdate date not null,
password varchar(20) not null,
gender bit,-- 0 male , 1 female
primary key(id)
);
