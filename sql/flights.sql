CREATE TABLE flights (
   id int(11) NOT NULL auto_increment,
   origin varchar(100) NOT NULL,
   destination varchar(100) NOT NULL,
   flight_date datetime,
   airline varchar(100) NOT NULL,
   aircraft varchar(100) NOT NULL,
   flight_number int(10) NOT NULL,
   availability int(3) NOT NULL,
   price float NOT NULL,
   PRIMARY KEY (id)
 );