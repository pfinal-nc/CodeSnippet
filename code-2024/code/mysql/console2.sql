use test;
CREATE TABLE movies
(
    id           INT PRIMARY KEY AUTO_INCREMENT,
    movie_name   VARCHAR(255),
    actors       VARCHAR(255),
    price        DECIMAL(10, 2) DEFAULT 50,
    release_date DATE
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

INSERT INTO movies (movie_name, actors, price, release_date)
VALUES ('咱们结婚吧', '靳东', 43.2, '2013-04-12'),
       ('四大名捕', '刘亦菲', 62.5, '2013-12-21'),
       ('猎场', '靳东', 68.5, '2017-11-03'),
       ('芳华', '范冰冰', 55.0, '2017-09-15'),
       ('功夫瑜伽', '成龙', 91.8, '2017-01-28'),
       ('惊天解密', '靳东', 96.9, '2019-08-13'),
       ('铜雀台', null, 65, '2025-12-16'),
       ('天下无贼', '刘亦菲', 44.9, '2004-12-16'),
       ('建国大业', '范冰冰', 70.5, '2009-09-21'),
       ('赛尔号4：疯狂机器城', '范冰冰', 58.9, '2021-07-30'),
       ('花木兰', '刘亦菲', 89.0, '2020-09-11'),
       ('警察故事', '成龙', 68.0, '1985-12-14'),
       ('神话', '成龙', 86.5, '2005-12-22');

# 通常用法
select * from movies order by movie_name asc;

# 进阶用法
select * from movies order by FIELD(movie_name,'神话','猎场','芳华','花木兰','铜雀台','警察故事','天下无贼','四大名捕','惊天解密','建国大业','功夫瑜伽','咱们结婚吧','赛尔号4：疯狂机器城'); -- 根据自定义的字段以及数据进行排序

#  空值 null 排序
                                                                                                                                           