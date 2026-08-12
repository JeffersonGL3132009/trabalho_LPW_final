create database videogames;
use videogames;
create table usuario (
idu int not null auto_increment primary key,
nomeu varchar(50) not null,
emailu varchar(50) not null unique,
senhau varchar(255) not NULL);

CREATE TABLE itens(
idi INT not null auto_increment primary KEY,
nomei varchar(50) NOT NULL,
tipo ENUM('jogo', 'videogame'),
imagem VARCHAR(225));

create table catalogo(
idc int not null auto_increment primary KEY,
itemc INT,
iduc INT,
foreign key (itemc) references itens(idi),
FOREIGN key (iduc) references usuario(idu));


CREATE TABLE info(
idf INT primary KEY not null AUTO_INCREMENT,
itemi INT,
datalanca DATE,
descricao VARCHAR(200),
foreign key (itemi) references itens(idi)
);

-- Usuário de teste para acessar o login (login.php aceita hash de password_hash()
-- ou, apenas para dados de teste antigos, senha em texto puro).
-- E-mail: teste@gamerate.com | Senha: 123456
INSERT INTO usuario (nomeu, emailu, senhau) VALUES
('Usuário Teste', 'teste@gamerate.com', '123456');



 
