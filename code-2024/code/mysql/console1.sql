show databases ;

-- SQL  数据脱敏实现
-- mysql 数据托名的实现
-- concat() left() 和 right() 字符串函数的组合使用

SELECT  CONCAT(LEFT('17621166911',3),'****',RIGHT('17621166911',4)) as 'phone'

SHOW DATABASES;
SELECT DATABASE();

