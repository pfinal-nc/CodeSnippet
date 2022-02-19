<?php

use GatewayWorker\Lib\Gateway;



/**
 * @Author: PFinal南丞
 * @Email: lampxiezi@163.com
 * @Date:   2021-04-12 15:16:34
 * @Last Modified time: 2021-04-13 15:50:55
 */


class Events
{
	public static $global_uid = 0;
	public static $global_i = 15;
	public static $global_j = 15;

	public static function onConnect($client_id)
    {
    	echo $client_id ."链接了\n";
    	$user_data = self::_getAllUser();
        $json = array('status' => 1, 'msg' => '', 'data' => array());
		$json['data']['name'] = $user_data[$client_id]['name'];

        Gateway::sendToCurrentClient(json_encode($json)); // 生成玩家昵称
        if(count($user_data)>1) {
        	// 分配对手
	        foreach ($user_data as $k => $val) {
	        	if ($val['playing'] == 0 && $k != $client_id) {
	        		//初始化棋盘
	            	$init_data = array();
	            	for ($i = 0; $i <= self::$global_i; $i++) {
		                for ($j = 0; $j <= self::$global_j; $j++) {
		                    $init_data[$i][$j] = 0;
		                }
	            	}
	            	$user_data[$k]['qipan'] = $init_data;
	            	$user_data[$client_id]['qipan'] = $init_data;
	            	$user_data[$k]['playing'] = $client_id;
	            	$user_data[$client_id]['playing'] = $k;
	            	
	            	// 分配红黑方
	            	$user_data[$k]['type'] = 1;
		            $user_data[$k]['move'] = 1;
		            $user_data[$client_id]['type'] = 2;
		            $user_data[$client_id]['move'] = 0;
		            $json = array('status' => 2, 'msg' => '', 'data' => array());
	 				$json['data']['qipan'] = $init_data;
	 				$json['data']['name'] = '为你匹配到对手'. $user_data[$client_id]['name'];

	        		Gateway::sendToClient($k,json_encode($json));
	        		
	        		$json2 = array('status' => 2, 'msg' => '', 'data' => array());
	 				$json2['data']['qipan'] = $init_data;
	 				$json2['data']['name'] = '为你匹配到对手'.$val['name'];

	        		Gateway::sendToClient($client_id,json_encode($json2));
	        		break;
	        	}
	        }
	        $_SERVER['user_data'] = $user_data;
        }
    }

    public static function onMessage($client_id, $message) {
    	echo $client_id."发送了".$message;
    	$data = json_decode($message, true);
    	var_dump($_SERVER['user_data']);
    	exit();
    	if($data['status'] == 2 && isset(self::$user_data[$client_id]) && self::$user_data[$client_id]['playing']!=0 && self::$user_data[$client_id]['move'] == 1) {
    		$my_uid = $client_id;
    		$your_uid = self::$user_data[$my_uid]['playing'];
    		$qipan =  self::$user_data[$your_uid]['qipan'];
        	$press = explode('_', $data['data']);
        	if (!empty($press)) {
            	$press_val = $qipan[$press[0]][$press[1]];
            	if ($press_val != 0) {
                	return;
            	} else {
        		 	$qipan[$press[0]][$press[1]] = self::$user_data[$my_uid]['type'];
        			self::$user_data[$my_uid]['qipan'] = $qipan;
	                self::$user_data[$your_uid]['qipan'] = $qipan;
	                self::$user_data[$your_uid]['move'] = 1;
	                self::$user_data[$my_uid]['move'] = 0;
	                $json = array('status' => 2, 'msg' => '', 'data' => array());
                	$json['data']['type'] = self::$user_data[$my_uid]['type'];
                	$json['data']['press_i'] = $press[0];
                	$json['data']['press_j'] = $press[1];
                	Gateway::sendToClient($my_uid,json_encode($json));
                	Gateway::sendToClient($your_uid,json_encode($json));

           //      	$count = self::get_who_win($qipan, $press[0], $press[1], self::$user_data[$my_uid]['type'], self::$global_i, self::$global_j);
        			// file_put_contents('./qipan', json_encode($qipan));
        			// if ($count >= 5) { //分出胜负
	          //           $json = array('status' => 3, 'msg' => self::$user_data[$my_uid]['name'] . ' Win !', 'data' => array());
	          //           $json['data']['type'] = self::$user_data[$my_uid]['type'];
	          //           Gateway::sendToClient($my_uid,json_encode($json));
           //      		Gateway::sendToClient($your_uid,json_encode($json));
           //      	}
        		}
    		}
    	}
	}


	public static function get_who_win($qipan = array(), $i = -1, $j = -1, $type = 0, $global_i = 0, $global_j = 0)
	{
		$count = 0;
	    $temp_type = $type;
	    if (empty($qipan) || $i < 0 || $j < 0 || $type <= 0) {
	        return $count;
	    }
	    echo json_encode($qipan)."\n";
	    echo 'i=' . $i . '|j=' . $j . '|type=' . $type . '|gi=' . $global_i . '|gj=' . $global_j . "\n";
	    /*左右上下的判断*/
	    $count = 1;
	    $a = array(
	        0 => array('index' => $j, 'border' => $global_j), //左右,
	        1 => array('index' => $i, 'border' => $global_i) //上下
	    );
	    for ($round = 0; $round <= 1; $round++) {
        	$mov1_num = 1;
        	$mov2_num = 1;
        	while (true) {
        		$mov1 = $a[$round]['index'] + $mov1_num;
        		$mov2 = $a[$round]['index'] - $mov2_num;
        		$temp_mov1 = $temp_mov2 = -1;
        		if ($mov1_num > 0) {
	                if ($round == 0 && $mov1 <= $global_j) {
	                    $temp_mov1 = $qipan[$i][$mov1];
	                    var_dump($i.','.$mov1.','.$temp_mov1);
	                } elseif ($round == 1 && $mov1 <= $global_i) {
	                    $temp_mov1 = $qipan[$mov1][$j];
	                }

	                if ($temp_mov1 == $temp_type) {
	                    $count++;
	                    var_dump('count='.$count);
	                    $mov1_num++;
	                } else {
	                    $mov1_num = 0;
	                }

	            } else {
	                $mov1_num = 0;
	            }

	            if ($mov2 >= 0 && $mov2_num > 0) {
	                if ($round == 0) {
	                    $temp_mov2 = $qipan[$i][$mov2];
	                    var_dump($i.','.$mov2.','.$temp_mov1);
	                } elseif ($round == 1) {
	                    $temp_mov2 = $qipan[$mov2][$j];
	                }
	                if ($temp_mov2 == $temp_type) {
	                    $count++;
	                    $mov2_num++;
	                } else {
	                    $mov2_num = 0;
	                }
	            } else {
	                $mov2_num = 0;
	            }
	            if ($count >= 5) {
	                return $count;
	            }

	            if (($mov1_num == 0 && $mov2_num == 0)) {
	                break;
	            }
        	}
    	}

    	// 斜角判断
    	$count = 1;
    	for ($round = 0; $round <= 1; $round++) {
	        $mov1_num = 1;
	        $mov2_num = 1;
	        while (true) {
	            $temp_mov1 = $temp_mov2 = -1;
	            if (($i - $mov1_num) >= 0 && ($j - $mov1_num) >= 0 && ($j + $mov1_num) <= $global_j && $mov1_num > 0) {
	                if ($round == 0) {
	                    $temp_mov1 = $qipan[$i - $mov1_num][$j + $mov1_num];
	                } elseif ($round == 1) {
	                    $temp_mov1 = $qipan[$i - $mov1_num][$j - $mov1_num];
	                }

	                if ($temp_mov1 == $temp_type) {
	                    $count++;
	                    $mov1_num++;
	                } else {
	                    $mov1_num = 0;
	                }

	            } else {
	                $mov1_num = 0;
	            }

	            if (($i + $mov2_num) <= $global_i && ($j - $mov2_num) >= 0 && ($j + $mov2_num) <= $global_j && $mov2_num > 0) {
	                if ($round == 0) {
	                    $temp_mov2 = $qipan[$i + $mov2_num][$j - $mov2_num];
	                } elseif ($round == 1) {
	                    $temp_mov2 = $qipan[$i + $mov2_num][$j + $mov2_num];
	                }
	                if ($temp_mov2 == $temp_type) {
	                    $count++;
	                    $mov2_num++;
	                } else {
	                    $mov2_num = 0;
	                }
	            } else {
	                $mov2_num = 0;
	            }
	            if ($count >= 5) {
	                return $count;
	            }
	            if (($mov1_num == 0 && $mov2_num == 0)) {
	                break;
	            }

        	}
    	}
    	return $count;
	}

    public static function onClose($client_id)
    {
       if (isset($_SESSION['id'])) {
            // 广播 xxx 退出了
            GateWay::sendToAll(json_encode(array('type'=>'closed', 'id'=>$_SESSION['id'])));
       }
    }

    public static function _getAllUser() 
    {
    	$user_data = [];
    	$user_list = Gateway::getAllClientIdList();
    	if($user_list) {
    		foreach ($user_list as $key => $value) {
    			$user_data[$key] = ['playing' => 0, 'name' => '玩家-PF' . $value, 'qipan' => array(), 'type' => 0, 'move' => 0];
    		}
    	}
    	return $user_data;
    }
}