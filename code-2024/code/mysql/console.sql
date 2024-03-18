SHOW DATABASES;


use ylb;
SELECT COUNT(*)
FROM huoma_channel;
SELECT COUNT(1)
FROM huoma_channel;

-- 上面的两种 在数据比较大的时候 查询就可能会超时, 需要换一种查询方式
SHOW TABLE STATUS LIKE 'huoma_channel';
-- 输出表的数据库 表名 数据量 索引大小 数据大

-- 磁盘空间 查看指定数据库容量大小
SELECT table_schema                            as '数据库',
       table_name                              as '表名',
       table_rows                              as '记录数',
       truncate(data_length / 1024 / 1024, 2)  as '数据容量(MB)',
       truncate(index_length / 1024 / 1024, 2) as '索引容量(MB)'
FROM information_schema.tables
ORDER BY data_length DESC, index_length DESC;

-- 查询单个库中所有表磁盘占用大小
SELECT table_schema                                               as '数据库',
       truncate(SUM(data_length + index_length) / 1024 / 1024, 2) as '磁盘占用(MB)'
FROM information_schema.TABLES
WHERE table_schema = 'ylb'
GROUP BY table_schema;

-- 如何解决单表数据量太大, 查询变慢的问题
-- 方案一 数据表分区
-- 表分区可以在区间内查询对应的数据,降低查询访问 并且索引分区 可以进一步提高命中率, 提升查询效率 分区是指将一个表的数据按照条件分布到不同的文件上面
-- 未分区前都是存放在一个文件上面的, 但是它 还是 指向的同一张表, 只是把数据分散到了不同文件而已

-- 表分区优点
-- 与单个磁盘或文件系统分区相比, 可以存储更多的数据
-- 对于那些已经失去保存意义的数据,通常可以铜鼓删除与那些数据有关的分区, 很容易地删除那些数据。相反地, 在某些情况下, 添加新数据的过程又可以通过为那些新数据专门增加一个新的分区,来很方便地实现
-- 一些查询可以得到极大的优化，这主要是借助于满足一个给定WHERE语句的数据可以只保存在一个或多个分区内，这样在查找时就不用查找其他剩余的分区。因为分区可以在创建了分区表后进行修改，所以在第一次配置分区方案时还不曾这么做时，可以重新组织数据，来提高那些常用查询的效率。
-- 涉及到例如SUM()和COUNT()这样聚合函数的查询，可以很容易地进行并行处理。这种查询的一个简单例子如 “SELECT salesperson_id, COUNT (orders) as order_total FROM sales GROUP BY salesperson_id；”。通过“并行”，这意味着该查询可以在每个分区上同时进行，最终结果只需通过总计所有分区得到的结果
-- 通过跨多个自盘来分撒数据查询, 来获得更大的查询吞吐量.


-- 表分区的限制因素
-- 一个表最多只能有1024个分区。
-- 如果分区字段中有主键或者唯一索引的列，那么多有主键列和唯一索引列都必须包含进来。
-- 即：分区字段要么不包含主键或者索引列，要么包含全部主键和索引列。
-- 分区表中无法使用外键约束。
-- MySQL的分区适用于一个表的所有数据和索引，不能只对表数据分区而不对索引分区，也不能只对索引分区而不对表分区，也不能只对表的一部分数据分区。

SHOW VARIABLES LIKE '%partition%'; -- 查询是否开启分区


SELECT GROUP_CONCAT(column_name)
FROM information_schema.columns
WHERE table_schema = 'ylb'
  AND table_name = 'huoma_channel';

-- char_length 字段长度函数

SELECT CHAR_LENGTH('pfinalclub');

-- Locate 函数

SELECT LOCATE('b', 'pfinalclub');


SELECT INSTR('pfinalclub', 'b');


SELECT POSITION('b' IN 'pfinalclub');


-- INSERT 在指定位置替换字符串
SELECT INSERT('pfinalclub', 3, 5, 'club');


-- replace 替换字符串
SELECT REPLACE('pfinalclub', 'b', 'club');
SELECT REPLACE(' PFINAL CLUB ', ' ', ''); -- 去掉空格


SET TIME_ZONE = '+8:00';
-- now 时间
SELECT NOW();


-- insert into ... ignore  判断 唯一索引的字段值是否存在 如果不存在则添加
-- INSERT ignore INTO users (id, name, email, created_at) VALUES (123, '108', '苏三', now(3));


-- select ... for update
-- mysql自带了悲观锁, 它是一种排它锁 根据锁的粒度从大到小分为: 表锁, 间隙锁 和 行锁
-- 实际场景业务中, 有些情况并发量不太高, 为了保证数据的正确性, 使用悲观锁也可以.

begin;
select *
from huoma_channel
where channel_id = 123 for
update;

update huoma_channel
set channel_id = 123
where channel_id = 123;
commit;

-- 这样在一个事务中使用 for update 锁住一行记录, 其他事务就不能再该事务提交之前去更新那一行的数据
-- 需要注意的是 for update 前的id 条件必须是表的 主键或者 唯一索引, 不然行锁可能会失效, 有可能变表锁

-- on duplicate key update
-- 通常情况下, 在插入数据之前, 一般会先查询一下, 该数据是否存在, 如果不存在, 则插入数据,如果已存在, 则不插入数据,而直接返回结果.
-- 在没啥并发量的场景中, 这种做法是没有什么问题的, 但如果插入数据的请求, 有一定的并发量, 这种做法就可能产生重复的数据.
-- 当然防止重复数据的做法很多, 比如: 加唯一索引, 加分布式锁等
-- 但这些方案, 都没法做到让第二次请求也更新数据, 他们一般会判断已经存在就直接返回了, 这种情况可以使用 on duplicate key update 语法
-- 该语法会在插入数据之前判断,如果主键或唯一索引不存在, 则插入数据, 如果主键或唯一索引存在,则执行更新操作.

SHOW CREATE TABLE huoma_channel;

INSERT INTO `huoma_channel`(`channel_id`, `channel_title`, `channel_pv`, `channel_creat_user`)
VALUES (123, '苏三', now(3), now(3))
ON DUPLICATE key update channel_pv = now(3);
-- 这样一条数据就能轻松搞定需求,既不会产生重复数据, 也能更新最新的数据,但需要注意的是, 在高并发的场景下使用 on duplicate key update 语法
-- 可能会存在 死锁的问题,所以要更具实际情况酌情使用


-- show create table

-- 有时候 快速的查看某张表的字段情况, 通常会使用 desc命令,

DESC `huoma_channel`;


-- 查看索引信息
SHOW INDEX FROM `huoma_channel`;


-- create table ... select
-- 有时候 需要快速的备份表, 通常情况下 分2步走
-- 1. 创建一张临时表
-- 2. 将数据插入临时表
-- 创建一个临时表
CREATE TABLE `huoma_channel_temp` LIKE `huoma_channel`;

-- 创建成功之后,就会生成一张 huoma_channel_temp 表结构跟 huoma_channel 一样的新表,
-- 将数据插入临时表
INSERT INTO `huoma_channel_temp`
SELECT *
FROM `huoma_channel`;

-- 使用 create table .. select 命令
CREATE TABLE `huoma_channel_temp`
SELECT *
FROM `huoma_channel`;

-- EXPLAIN
-- 很多时候, 我们优化一条sql 语句的性能, 需要查看索引执行情况,

EXPLAIN SELECT *
FROM `huoma_channel`
WHERE channel_id = 123;

-- EXPLAIN 字段信息
-- id(select唯一标识)  select_type(select 类型) table(表名称) partitions(匹配的分区) key(实际用到的索引) key_len(实际索引长度) ref(与索引关联的表) rows(实际返回的行数) Extra(额外信息) filtered(过滤后的行数)

-- 索引失效的常见原因:
-- 不满足最左前缀原则
-- 范围索引列没有放最后
-- 使用了 select *
-- 索引列上有计算
-- 索引列上有函数
-- 字符类型没加引号
-- 用 is null 和 is not null 没注意字段是否允许为空
-- like 查询左边有 %
-- 使用 or 关键字时没有注意



-- MySql 事务的底层原理
-- Mysql是支持事务并发执行的, 在数据事务中并发问题是: A,事务来写某条记录的数据, B 事务也在写该条记录的数据, 如果啥也不做,势必会造成数据的错乱, Mysql 在设计之初就考虑到了这个问题.
-- MySql 使用了MVCC 多版本控制机制, 事务隔离机制, 锁机制等办法来解决事务并发问题,
-- 脏数据 具体有 脏些，脏读，不可重复读， 幻读，

-- 脏写
-- 脏写 是指一个事务修改且已经提交的数据被另外一个事务给回滚了.
-- 首先来分析一下: 假设有两个事务, A,B。事务A 先开启事务, 并且修改了一条 id 为1 的记录.将name 改成了 A 但是此时,事务A 还没有提交, 这时候事务B 开启了, 事务B 将id 为1 的记录中 name 改成 B  并且
-- 将事务提交了. 但是这个时候事务A 不想修改了, 就像之前自己修改的数据回滚了, 就就是说此时导致的结果是 id 为 1 的这条记录的 name 还是没有被修改之前的.
-- 然后事务 B 去查询这条记录的时候,结果懵逼, name 居然没有修改, 这就是脏写，
-- 使用锁解决脏写问题, 在开启一个事务的时候, 会将某条记录和事务做一个绑定, 这个其实和jvm锁是类似的, 因为此时事务A 先启动了,并关联绑定了这条记录.所以事务B 此时如果操作同样的记录, 只能等待, 当事务A 执行完毕了.
-- 就会通知正在等待事务,然后下一个事务继续执行

-- 脏读
-- 脏读 是指一个事务读取到了另外一个事务没有提交的记录,
-- 有两个事务A,B 事务A 先开启了, 将  id为1的记录中的name 改成了 A , 但是还没有提交, 此时 事务B 开启了 事务 B 查询到当前 name 的值为 A 然后就会按照 A逻辑去执行处理.结果事务A 回滚了事务, 事务 B 再次查询的时候发现记录值不是A 这就是脏读


-- 不可重复读
-- 不可重读读 是指前后读取到的某条记录的结果不一样
-- 假设有三个事务, A,B,C 事务A 先开启了,但是还没有执行任何的操作, 事务 B开启了, 事务B 将id 为1 的记录的name 改为 B 并提交嘞事务. 此时事务A 开始活动了, 查询到的这条记录的name 值为 B 还是未执行任何操作. 此时事务C 开启了
-- 事务C 将ID 为 1 的记录的 name 改为C 并提交了事务. 此时事务 A 又开始活动了，结果查询到的 id 为 1 的 name 值又变成了 C。这就是不可重复读


-- 幻读
-- 幻读是指前后读取到的记录的数量不一样
-- 幻读和不可重读有点类似, 不可重复读强调的是 数据的值不一样,重点是修改, 而幻读强调的是 记录的数量不一样, 重点是新增或删除
-- 有两个事务 A, B 事务A 先开启了, 并执行了这样的 SQL: select * from user 查询的结果是5条, 此时 事务B 开启了, 并往  user 表中插入一条记录,并提交嘞事务,此时 事务A 又执行了 select * from user 结果发现是6条记录 这就是所谓的幻读

-- 事务的隔离级别

-- 1. 读取未提交  意思就是一个事务能够读取到另一个事务未提交的修改
-- 2. 读取已提交  就是一个事务能读取另一个事务已经提交了的修改
-- 3. 可重复读 mysql 的默认隔离级别 即事务之间只要在进行中, 彼此之间不会有任何的干扰
-- 4. 串行izable  所有的请求只能一个一个来还行，很显然效率最低，基本也不会使用这种隔离剂


-- MVCC 机制
-- MVCC 即多版本并发控制, mvcc是一种并发控制的方法,一般在数据库管理系统重,实现对数据库的并发访问;


