<?php
/**
 * @author pfinal南丞
 * @date 2021年04月21日 下午7:49
 */
ini_set("display_errors", "On");
error_reporting(E_ALL);
$dbms = 'mysql';     //数据库类型
$host = '192.168.5.245'; //数据库主机名
$dbName = 'd_mediasdk';    //使用的数据库
$user = 'root';      //数据库连接用户名
$pass = 'ggg123';          //对应的密码
$dsn = "$dbms:host=$host;dbname=$dbName";
require __DIR__ . '/../vendor/autoload.php';
$hosts = [
    '172.100.0.10:9200',         // IP + 端口
];
$clientBuilder = \Elasticsearch\ClientBuilder::create();   // 实例化 ClientBuilder
$clientBuilder->setHosts($hosts);           // 设置主机信息
$client = $clientBuilder->build();
$params = ['body' => []];

function ad_format($segment_id, $ad_unit_id, $app_id)
{
    return ['app_id' => $app_id, 'ad_unit_id' => $ad_unit_id, 'segment_id' => explode(',', $segment_id)];
}

function ad_format_name($ad_format)
{

}


function ad_unit_format($adunit, $app_id)
{
    $ad_unit_info = [];
    $ad_unit_list = explode(',', $adunit);
    if ($ad_unit_list) {
        foreach ($ad_unit_list as $item) {
            $info = explode('|', $item);
            $tmp['ad_unit_id'] = $info[0];
            $tmp['ad_format'] = $info[1];
            $tmp['ad_key'] = $info[2];
            $tmp['ad_type'] = $info[3];
            $tmp['init_true'] = ($info[1] == 5 ? 1 : 0);
            $ad_unit_info[] = $tmp;
        }
    }
    return ['app_id' => $app_id, 'ad_units' => $ad_unit_info];
}


try {
    $db_connect = new \PDO($dsn, $user, $pass); //初始化一个PDO对象
    echo "Mysql连接成功<br/>";
    $redis = new Redis();
    $redis->pconnect('172.100.0.6', 6379);
    echo "Redis连接成功<br/>";
    // Redis中缓存所有的广告位
    $ad_unit_list_sql = 'SELECT GROUP_CONCAT(`id`,\'|\',`ad_format`,\'|\',`key`,\'|\',`ad_type`) as adunit,app_id FROM t_media_ad_units WHERE status=1  GROUP BY app_id';
    $db_model = $db_connect->prepare($ad_unit_list_sql);
    $db_model->execute();
    $ad_unit_list = $db_model->fetchAll(PDO::FETCH_FUNC, 'ad_unit_format');
    if($ad_unit_list) {
        foreach ($ad_unit_list as $adunit) {
            $redis->hSet('configs_adunit', $adunit['app_id'], json_encode($adunit['ad_units']));
        }
    }

    $app_segment_list_sql = "SELECT group_concat(id) as segment_id,ad_unit_id,app_id FROM t_media_segment WHERE app_id IN (SELECT DISTINCT id FROM t_media_app WHERE `status`=1 ORDER BY id DESC) AND `status`=1 GROUP BY app_id,ad_unit_id";
    $db_model = $db_connect->prepare($app_segment_list_sql);
    $db_model->execute();
    $result = $db_model->fetchAll(PDO::FETCH_FUNC, 'ad_format');
    // 批量缓存广告策略
    $redis->multi();
    foreach ($result as $item) {
        $segment_list_sql = 'SELECT * FROM t_media_segment WHERE id IN(' . implode(',', $item['segment_id']) . ') ORDER BY order_id ASC ';
        $db_model = $db_connect->prepare($segment_list_sql);
        $db_model->execute();
        $segment_list = $db_model->fetchAll(PDO::FETCH_ASSOC);
        $redis->hSet('configs_segment', $item['app_id'] . '_' . $item['ad_unit_id'], json_encode($segment_list));
        // 批量缓存广告来源
        foreach ($item['segment_id'] as $segment_id) {
            $ad_source_list_sql = 'SELECT * FROM t_media_ad_source WHERE segment_id=' . $segment_id . ' AND status=1  ORDER BY sort ASC';
            $db_model = $db_connect->prepare($ad_source_list_sql);
            $db_model->execute();
            $ad_source_list = $db_model->fetchAll(PDO::FETCH_ASSOC);
            if (count($ad_source_list) > 0) {
                $redis->hSet('configs_adsource', $item['app_id'] . '_' . $item['ad_unit_id'] . '_' . $segment_id, json_encode($ad_source_list));
            }
        }
    }


    // Elasticsearch 中建立索引
    $params['body'] = [];
    foreach ($result as $item) {
        $segment_info_sql = 'SELECT * FROM t_media_segment WHERE id IN(' . implode(',', $item['segment_id']) . ') ORDER BY order_id ASC ';
        $db_model = $db_connect->prepare($segment_info_sql);
        $db_model->execute();
        $segment_list = $db_model->fetchAll(PDO::FETCH_ASSOC);
        foreach ($segment_list as $value) {
            $params['body'][] = [
                'create' => [
                    '_index' => 'app_configs',
                    '_id'    => $item['app_id'] . '_' . $item['ad_unit_id'] . '_' . $value['id']
                ]
            ];
            $params['body'][] = [
                'app_ad_unit'           => $item['app_id'] . '_' . $item['ad_unit_id'],
                'segment_id'            => $value['id'],
                'channel_operating'     => $value['channel_operating'],
                'channel_value'         => $value['channel_value'],
                'app_version_operating' => $value['app_version_operating'],
                'app_version_value'     => $value['app_version_value'],
                'app_version_start'     => $value['app_version_start'],
                'app_version_end'       => $value['app_version_end']
            ];
        }
    }
    $responses = $client->bulk($params);
    echo '<pre>';
    print_r($responses);
    // }


//    $redis->exec();
//    $list = $redis->hGetAll('configs');
//    echo '<pre>';
//    print_r($list);
//    $ad_source_list = $redis->hGetAll('configs_adsource');
//    echo '<pre>';
//    print_r($ad_source_list);
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage() . "<br/>");
}