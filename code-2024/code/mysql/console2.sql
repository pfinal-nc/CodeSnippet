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
select *
from movies
order by movie_name asc;

# 进阶用法
select *
from movies
order by FIELD(movie_name, '神话', '猎场', '芳华', '花木兰', '铜雀台', '警察故事', '天下无贼', '四大名捕', '惊天解密',
               '建国大业', '功夫瑜伽', '咱们结婚吧', '赛尔号4：疯狂机器城');
-- 根据自定义的字段以及数据进行排序

#  空值 null 排序
# mysql 排序 如果字段中存在 NULL值就会对排序结果造成影响, 这时候使用 order by if(isnull(字段), 1, 0) asc 语法将NULL 值转换成 0 或者 1 实现 null 值数据排序到数据集前面还是后面

# 如果字段的值是 null(isnull(字段)返回真) 则IF函数返回0
# 如果字段的值不是null IF函数返回1

select *
from movies
ORDER BY actors, price desc;

select *
from movies
ORDER BY if(ISNULL(actors), 0, 1), actors, price desc;
# 相反 如果想让 null 值排序在最后,可以将表达式中的0和1 互换位置.


# Case 表达式

CREATE TABLE student
(
    student_id varchar(10) NOT NULL COMMENT '学号',
    sname      varchar(20) DEFAULT NULL COMMENT '姓名',
    sex        char(2)     DEFAULT NULL COMMENT '性别',
    age        int(11)     DEFAULT NULL COMMENT '年龄',
    score      float       DEFAULT NULL COMMENT '成绩',
    PRIMARY KEY (student_id)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4 COMMENT ='学生表';

INSERT INTO student (student_id, sname, sex, age, score)
VALUES ('001', '张三', '男', 20, 95),
       ('002', '李四', '女', 22, 88),
       ('003', '王五', '男', 21, 90),
       ('004', '赵六', '女', 20, 74),
       ('005', '陈七', '女', 19, 92),
       ('006', '杨八', '男', 23, 78),
       ('007', '周九', '女', 20, 55),
       ('008', '吴十', '男', 22, 91),
       ('009', '刘一', '女', 21, 87),
       ('010', '孙二', '男', 19, 60);

# 学生90分以上评为优秀，分数80-90评为良好，分数60-80评为一般，分数低于60评为“较差”。

select *,
       case
           when score > 90 then '优秀'
           when score > 80 then '良好'
           when score > 60 then '一般'
           else '较差' end level
from student;

# 分组链接函数 (group_concat)
# 分组连接函数 可以在分组后指定字段的字符串连接方式,并且还可以指定排序逻辑,连接字符串默认为英文逗号.
# 比如说根据演员进行分组, 并将相应的电影名称按照票价进行降序排列, 而且电影名称之间通过 "_"拼接,

select actors,
       GROUP_CONCAT(movie_name),
       GROUP_CONCAT(price)
from movies
GROUP BY actors;
-- 上面查询返回每个演员参演的所有电影名称和价格, 但这些值将以默认的逗号分隔符链接在一起


select actors,
       group_concat(movie_name order by price desc SEPARATOR '_'),
       group_concat(price order by price desc SEPARATOR '_')
from movies
GROUP BY actors;

-- 上面的查询将电影名称和价格连接成字符串,而且还按照价格降序排列, 并使用下划线作为分隔符, 这意味着每个演员参演的电影将按价格从高到低排列, 电影名称和价格之间用下划线分隔。

# 分组统计数据后再进行统计汇总 (with rollup)
# 在mysql 中可以使用 with rollup 在分组统计数据的基础上再进行统计汇总,即将分组后的数据进行汇总.
select actors, SUM(price)
FROM movies
GROUP BY actors;

SELECT actors, SUM(price)
FROM movies
GROUP BY actors
WITH ROLLUP;


# 子查询提取 (with as)
# 如果一整句查询中多个子查询都需要使用同一个子查询的结果， 那么就可以用 with as 将共用的子查询提取出来并取一个别名, 后面查询语句可以直接使用. 对于 大量负责的sql语句起到了很好的额优化作用

-- with m1 as (select * from movies where actors = '靳东')   select * from m1;

# 优雅处理数据插入, 更新时主键, 唯一键重复
# 再mysql 中插入, 更新数据时有时候遇到主键重复的场景， 通常的做法就是先进行删除在插入达到可重复执行效果, 但是这种方法有时候会错误删除数据
# 1. 插入数据时我们可以使用 IGNORE, 它的作用是插入的值遇到主键或者唯一键重复时自动忽略重复的数据, 不影响后面数据的插入, 即有则忽略 无则插入.

select *
from movies
where id >= 13;
# INSERT INTO movies (id, movie_name, actors, price, release_date) VALUES (13, '赤裸裸', '靳东', 50, '2013-04-12');
# INSERT INTO movies (id, movie_name, actors, price, release_date) VALUES (13, '赤裸裸', '靳东', 50, '2013-04-12');
# INSERT INTO movies (id, movie_name, actors, price, release_date) VALUES (13, '赤裸裸', '靳东', 50, '2013-04-12');

# 2. 还可以使用 REPLACE 关键字, 当插入的记录遇到主键或者唯一键重复时先删除表中重复的记录行再插入,即有则删除+插入, 无则插入
REPLACE INTO movies(id, movie_name, actors, price, release_date)
VALUES (14, '神话2', '成龙', 100, '2005-12-22');
REPLACE INTO movies (id, movie_name, actors, price, release_date)
VALUES (15, '神话3', '成龙', 115, '2005-12-22');

# 3 更新数据时使用 on duplicate key update, 它的作用就是当插入的记录遇到主键或者唯一键重复时,会执行后面定义的update操作, 相当于先执行 insert操作.再根据主键或者唯一执行 update 操作.
# 即有就更新,没有插入
INSERT INTO movies (id, movie_name, actors, price, release_date) VALUES (16, '赤裸裸', '靳东', 50, '2013-04-12') on duplicate  key update price = price + 10;
INSERT INTO movies (id, movie_name, actors, price, release_date) VALUES (16, '赤裸裸', '靳东', 50, '2013-04-12') on duplicate  key update price = price + 10;

SELECT * FROM movies;

# 操作 delete 或者 update 语句, 加个 limit(SQL后悔药)
# 在执行删除或者更新语句, 尽量加上 limit
delete from movies where price > 50 limit 5;

# 加 limit 主要的作用:
# 降低写错 sql 的代价 -- 在命令行执行这个sql的时候,如果不加limit 执行的时候 一个 不小心 手抖, 可能数据全删掉了, 如果删错 加了 limit 删错了也只是丢失一部分数据 可以通过 binglog日志快速恢复
# sql效率可能更高
# 可以避免长事务
# 数据量过大, 容易把 CPU 打满

# 索引命名 主键索引名为 pk_字段名, 唯一索引为 uk_字段名, 普通索引名则为 idx_字段名
# pk_即 primary key; uk_即 unique key; idx_即 index的简称

# where 从句中不对列进行函数转换和表达式计算
# explain  select userId,loginTime
#          from loginuser
#          where  loginTime >= Date_ADD(NOW(),INTERVAL - 7 DAY);

