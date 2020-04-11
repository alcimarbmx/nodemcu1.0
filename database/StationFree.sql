/*
  Modelar banco de dados para armazenar todas as informações adquiridas dos sensores.
  Assim, será possível acessar precisamente cada informação armazenada este. Para tal,
  deverá ser criada uma tabela para cada sensor.
*/


create database station;
use station;

create table bmp180(
  id_bmp int auto_incremet primary key,
  temp varchar(40),
  altMar varchar(40)
  pMar varchar(40),
  PAtm varchar(40)
);

create table dht11(
  id_dht int auto_incremet primary key,
  temp varchar(40),
  umid varchar(40)
);

create table instColeta(
  id_inst int auto_incremet primary key,
  horario datetime
);
