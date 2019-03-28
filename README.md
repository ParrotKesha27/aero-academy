# aero-academy
Тестовое задание в Академию AERO. Выполнил: Игнат Краснов. E-mail: parrotkesha27@gmail.com

Версия nginx: 1.14.2
Версия MySQL: 5.6.43

Создание БД:

CREATE DATABASE aero; 
 
USE aero; 
 
CREATE TABLE academy (fullname CHAR(75), phonenumber CHAR(12), email CHAR(50), birthday DATE, comment TEXT);
