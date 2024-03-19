show PROCESSLIST; -- 显示那些线程正在运行
show variables;  -- 显示系统变量信息

SELECT database();  -- 显示当前数据库

SELECT now(),user(),version(); -- 显示当前时间,用户名, 数据库版本

SHOW DATABASES; -- 显示所有数据库

SHOW DATABASES LIKE "test";

# mysql 大表添加一列
ALTER TABLE movies ADD COLUMN new_column VARCHAR(255)
#  上面的语句 在大表中会造成锁表, 简易过程如下:
# 1. 新建一个 和 movies 完全同结构的 表 table2
# 2. 对表 movies 加写锁
# 3. 在表 table2 上执行 ALTER TABLE movies ADD COLUMN new_column VARCHAR(255)
# 4. 将 movies 中的数据拷贝到table2
# 5.将 table2 重新命名为 movies 并移除 movies 释放所有相关的锁

# 针对大表可以使用
ALTER TABLE movies ADD COLUMN new_column VARCHAR(255), ALGORITHM=INPLACE, LOCK=NONE;
-- 实现在线增加字段。最好还是明确 ALGORITHM 以及 LOCK，这样执行 DDL 的时候能明确知道到底会对线上业务有多大影响

# ALGORITHM 参数
# 1. DEFAULT 默认方式, 在8.0中 如果未显式指定 ALGORITHM 会有限选择 INSTANT 算法 如果不行 再使用 INPLACE 算法, 如果不支持 INPLACE 算法则使用 copy的方式完成
# 2. INSTAN 添加列是立即返回,但是不能是虚拟列

# LOCK 参数
# DEFAULT：和 ALGORITHM 的 DEFAULT 类似
# NONE：无锁，允许并发读取和更新表
# SHARED：共享锁，允许读取不允许更新
# EXCLUSIVE：不允许读取和更新


