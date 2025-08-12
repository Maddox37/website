create database empresa;
use empresa;

 -- Tablas // esto esta medio flojo asi que cuando termine aviseme para añadir mas cosas.
 
 create table usuario(
 nombre varchar(100) NOT NUll,
 contraseña varchar(100) NOT NULL,
 email varchar(100) NOT NULL,
 id int auto_increment primary key
 );
 
  create table administrador(
 nombre varchar(100) NOT NUll,
 contraseña varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
 id int auto_increment primary key
 );
 
create table pedidos(
producto varchar(100) NOT NULL,
cantidad int,
fecha DATE NOT NULL,
id int auto_increment primary key
 );

 create table productos(
 nombre varchar(100) NOT NULL,
 descripcion varchar(200) NOT NULL,
 imagen varchar(200) NOT NULL,
 precio decimal NOT NULL,
 empresa varchar(100) NOT NULL,
 cantidad int,
 id int auto_increment primary key
 );

 ALTER TABLE productos ADD COLUMN usuario_id INT NOT NULL;