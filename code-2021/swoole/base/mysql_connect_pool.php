<?php
/**
 * @author pfinal南丞
 * @date 2021年10月18日 下午3:29
 */

class MysqlPool
{
    protected $available = true;
    public $pool;
    protected $config; //mysql 服务的配置文件
    protected $max_connection = 50; //链接池最大链接
    protected $min_connection = 20; //
    protected $currnet_connection = 0; // 当前链接数

    public function __construct($config)
    {
        $this->config = $config;
        $this->pool   = new SplQueue;
        $this->initPool();
    }

    public function initPool()
    {
        go(function () {
            for ($i = 1; $i <= $this->min_connection; $i++) {
                $this->pool->push($this->newMysqlClient());
            }
        });
    }

    public function put($mysql)
    {
        $this->pool->push($mysql);
    }

    public function get()
    {
        //有空闲的链接切连接池处于可用状态
        if ($this->available && $this->pool->length > 0) {
            return $this->pool->pop();
        }
        // 无空闲链接 创建新的链接
        $mysql = $this->newMysqlClient();
        if ($mysql == false) {
            return false;
        } else {
            return $mysql;
        }
    }

    protected function newMysqlClient()
    {
        if ($this->currnet_connection >= $this->max_connection) {
            throw new Exception("链接池已经满了");
        }
        $this->currnet_connection++;

    }
}