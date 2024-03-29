show PROCESSLIST; -- 显示那些线程正在运行
show variables; -- 显示系统变量信息

SELECT database(); -- 显示当前数据库

SELECT now(), user(), version(); -- 显示当前时间,用户名, 数据库版本

SHOW DATABASES; -- 显示所有数据库

SHOW DATABASES LIKE "test";

# mysql 大表添加一列
ALTER TABLE movies
    ADD COLUMN new_column VARCHAR(255)
#  上面的语句 在大表中会造成锁表, 简易过程如下:
# 1. 新建一个 和 movies 完全同结构的 表 table2
# 2. 对表 movies 加写锁
# 3. 在表 table2 上执行 ALTER TABLE movies ADD COLUMN new_column VARCHAR(255)
# 4. 将 movies 中的数据拷贝到table2
# 5.将 table2 重新命名为 movies 并移除 movies 释放所有相关的锁

# 针对大表可以使用
ALTER TABLE movies
    ADD COLUMN new_column VARCHAR(255),
    ALGORITHM = INPLACE,
    LOCK = NONE;
-- 实现在线增加字段。最好还是明确 ALGORITHM 以及 LOCK，这样执行 DDL 的时候能明确知道到底会对线上业务有多大影响

# ALGORITHM 参数
# 1. DEFAULT 默认方式, 在8.0中 如果未显式指定 ALGORITHM 会有限选择 INSTANT 算法 如果不行 再使用 INPLACE 算法, 如果不支持 INPLACE 算法则使用 copy的方式完成
# 2. INSTAN 添加列是立即返回,但是不能是虚拟列

# LOCK 参数
# DEFAULT：和 ALGORITHM 的 DEFAULT 类似
# NONE：无锁，允许并发读取和更新表
# SHARED：共享锁，允许读取不允许更新
# EXCLUSIVE：不允许读取和更新

# POWER 函数 用于计算一个数的指定次幂
SELECT POWER(2, 3);

# ABS()  函数 用于计算一个数的绝对值
SELECT abs(-5);
SELECT ABS(5);

#  CEILING / CEIL() 函数  用于向上取整, 即将一个数向上舍入到最接近的整数,

SELECT CEILING(4.2);

# ROUND() 函数用于 四舍五入到指定的小数位数,接收两个参数, 要处理的数值和保留的小数位数

SELECT ROUND(3.14159265, 2);
SELECT ROUND(4.7);


# Mysql 踩坑
# NULL<>NULL 的结果返回的是 NULL 而不是 false
# NULL=NULL 返回的结果是 NULL 而不是 true
# NULL<>1 的返回结果是 NULL 而不是 true
# NULL=1 的返回结果是 NULL 而不是 false
# NULL 与任何值的直接比较都为 NULL

-- 用 ISNULL 符号判断
SELECT *
FROM `movies`
WHERE ISNULL(actors);

-- 使用空字符串函数来判断列表是否为空,
-- 使用LENGTH函数来判断字符串长度
SELECT *
FROM movies
WHERE length(actors) = 0
   OR ISNULL(actors);


# count(*) 和 count(column) 函数

SELECT COUNT(*)
FROM movies;
SELECT COUNT(actors)
FROM movies;

# count(*) 用于计算整个表中的行数, 包括所有的行 无论是否包含 NULL值。 由于不需要指定具体的列名, 因此它更简洁和方便
# 当使用 COUNT(*)时, 数据库引擎需要遍历整个表来计算行数,可能会导致性能问题, 特别是对于大型表而言

# COUNT(column) 用于计算指定列中非 NULL 值的行数,可以指定具体的列名, 只计算该列中非 NULL 值的行数,因此需要计算包括NULL值的行数,应该使用 count(*) 而不是 COUNT(column)
# 如果使用COUNT(*) 或 COUNT(column) 时, 查询结果集中没有匹配的行,则count函数返回值为0, 即使列中包含NULL值
# 如果使用 COUNT(column) 时, 查询结果集中只有NULL值的行,则 COUNT 函数返回值为0, 因为它只计算非 NULL值的行数.
SELECT COUNT(*)
FROM movies; -- 11
SELECT COUNT(actors)
FROM movies;
-- 10

# 如果使用 COUNT(*) 时候, 查询结果集中只有NULL 值的行, 则 COUNT 函数的返回值为 包含NULL值的行数
# 如果使用 COUNT(*) 或 COUNT(column) 时 查询结果集中既有NULL值的行, 又有非NULL值的行, 则COUNT 函数的返回值将包括非 NULL 值的行数

# COUNT 和 DISTINCT


# DISTINCT 用于对查询结果进行去重操作.
--  对多个列进行去重
SELECT DISTINCT actors, price
FROM movies;
# COUNT 和 DISTINCT 可以结合使用 计算去重后的行数
SELECT COUNT(DISTINCT actors)
FROM movies;

# 多表连接的 COUNT
# 在多表连接查询中,如果想要计算负荷条件的行数, 可以用 COUNT函数结果链接操作来实现
SELECT COUNT(DISTINCT m.id) as row_count
FROM movies as m
         JOIN student as s ON m.id = s.student_id
where 1 = 1;
# 使用了COUNT(*) 函数来计算满足链接条件和其他条件的行数

# 在没有索引的情况下, count() 操作可能会非常慢, 尤其是当表中的数据量很大时 这是因为MySQL 需要扫描整个表来计算行数
# 对于COUNT(*) innoDB 引擎会尝试使用数据量较小的非聚簇索引来优化 count() 查询, 如果没有合适的索引 查询可能会使用全表扫描, 导致性能下降


# MYSQL 递归查询
CREATE TABLE `organization`
(
    `org_id`    int                                                           NOT NULL COMMENT '主键',
    `org_name`  varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '组织名称',
    `parent_id` int DEFAULT NULL COMMENT '父组织id',
    `org_level` int DEFAULT NULL COMMENT '组织级别',
    PRIMARY KEY (`org_id`),
    KEY `parent_id` (`parent_id`),
    CONSTRAINT `organization_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `organization` (`org_id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci COMMENT ='公司组织架构';

INSERT INTO `organization`(`org_id`, `org_name`, `parent_id`, `org_level`)
VALUES (1, '集团总部', NULL, 1);
INSERT INTO `organization`(`org_id`, `org_name`, `parent_id`, `org_level`)
VALUES (2, '华北分公司', 1, 2);
INSERT INTO `organization`(`org_id`, `org_name`, `parent_id`, `org_level`)
VALUES (3, '华南分公司', 1, 2);
INSERT INTO `organization`(`org_id`, `org_name`, `parent_id`, `org_level`)
VALUES (4, '华北-北京公司', 2, 3);
INSERT INTO `organization`(`org_id`, `org_name`, `parent_id`, `org_level`)
VALUES (5, '华北-内蒙公司', 2, 3);
INSERT INTO `organization`(`org_id`, `org_name`, `parent_id`, `org_level`)
VALUES (6, '华南-广州公司', 3, 3);
INSERT INTO `organization`(`org_id`, `org_name`, `parent_id`, `org_level`)
VALUES (7, '华南-深圳公司', 3, 3);

# 使用递归查询分页查看组织架构

# WITH RECURSIVE tree as (
#     SELECT org_id,org_name,parent_id,org_level
#     FROM organization
#     WHERE parent_id is NULL -- 查找根节点
#     UNION ALL
#     SELECT o.org_id,o.org_name,o.parent_id,o.org_level
#     FROM organization o
#              INNER JOIN tree t ON o.parent_id = t.org_id
# )
# SELECT org_id,org_name,org_level,parent_id
# FROM tree
# ORDER BY org_level,org_id
# LIMIT 2 OFFSET 0;  -- 设置每页的条目数量和偏移量

SELECT VERSION();

SHOW VARIABLES LIKE "%query_cache%";
# have_query_cahce 当前的mysql版本是否支持查询缓存功能
# query_cache_limit 能够缓存的最大查询结果.
# query_cache_min_res_unit 查询缓存的最小单位
# query_cache_size 为缓存查询结果分配的总内存
# query_cache_type 默认为on 可以缓存除了select sql_no_cache开头的所有查询结果
# query_cache_wlock_invalidate 如果该表被锁住，是否返回缓存中的数据，默认是关闭的


SHOW STATUS;

SELECT @@tx_isolation;
--  查询当前事务的隔离级别 REPEATABLE-READ(可重读性) READ-UNCOMMITTED(不可重读) READ-COMMITTED(可重读性) SERIALIZABLE(串行性)

-- 劲量避免隐含的类型转换

SELECT *
FROM movies
WHERE id = '1'; -- (错)

SELECT *
FROM movies
WHERE id = 1;
-- (对)

# id 是整数型, 用'1'会默认启动类型转换, 增加查询的开销

# 尽量减少使用 正则表达式, 尽量不使用通配符
# 使用关键字代替函数

SELECT * FROM movies where UPPER(actors) LIKE '%冰%';   -- 不建议
SELECT * FROM movies where SUBSTR(actors, 1, 2) = '范'; -- 不建议
SELECT SUBSTR('hello', 1, 2);
SELECT * FROM movies WHERE actors LIKE '%冰%';

# 不在在字段上用 转换函数,尽量在常量上用
# SELECT * FROM movies WHERE to_char(create_date,'yyyy') = '2021'; -- 不建议
SELECT * FROM movies WHERE YEAR(release_date) = 2021; -- 不建议
SELECT * FROM movies WHERE release_date=str_to_date('2021-12-21','%Y-%m-%d');

# 不使用联接做查询
# SELECT * FROM movies WHERE movie_name || actors like "%范冰%" -- 不建议

# 尽量避免前后都用通配符
SELECT * FROM movies WHERE actors like "%冰%"; -- 不建议
SELECT * FROM movies WHERE actors like "范%";

# 判断条件顺序
SELECT * FROM movies WHERE release_date-30>str_to_date('2021-12-21','%Y-%m-%d'); -- 不建议
SELECT * FROM movies WHERE release_date > str_to_date('2021-12-21','%Y-%m-%d')+30;

# 尽量使用 exists 而非in
SELECT id FROM movies WHERE id in (SELECT id FROM movies); -- 不建议
SELECT actors FROM movies WHERE id>10;
SELECT id FROM movies where EXISTS (SELECT actors FROM movies WHERE id<10);

# 使用 not exists 而非 not in 代码和上面的类似

# 减少查询表的记录数范围
# 正确使用索引 索引可以提高速度, 一般来说, 选择度越高, 索引的效率越高
# 唯一索引,对于查询用到的字段, 尽可能使用唯一索引. 还有一些其他类型
# 索引类型
# 唯一索引, 对于查询用到的字段,尽可能使用唯一索引


# 优化 sql 常用的
# 1.尽量避免在 where 子句中 使用 != 或 <> 操作符 否则将引擎放弃使用索引而进行全表扫描
# 2.对查询进行优化, 应尽量避免全表扫描, 首先应考虑在 where 及 order by 涉及的列表建立索引
# 3.应尽量避免在 where 子句中对字段进行 null 值判断，否则将导致引擎放弃使用索引而进行全表扫描。如：where id is null










