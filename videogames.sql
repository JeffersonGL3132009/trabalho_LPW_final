create database videogames;
use videogames;
create table usuario (
idu int not null auto_increment primary key,
nomeu varchar(50) not null,
emailu varchar(50) not null,
senhau varchar(20) not null);

create table catalogo(
idc int not null auto_increment primary key,
foreign key (itemc) references videogames(idv),
FOREIGN key (iduc) references usuario(idu));
 

 
