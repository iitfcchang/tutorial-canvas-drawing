create database if not exists drawingsdb;
create user if not exists drawingsappl identified by 'test1234';
grant all privileges on drawingsdb.* to drawingsappl;
use drawingsdb;
drop table if exists drawings;
create table drawings (
	    id integer auto_increment,
	    name text not null,
	    ctime timestamp default current_timestamp,
	    primary key (id)
);
