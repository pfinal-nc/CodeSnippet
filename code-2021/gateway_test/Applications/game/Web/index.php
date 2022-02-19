<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<h3 class="player">玩家</h3>
<table border="1">
    <?php
    for ($i = 0;$i <= 15; $i++) {?>
    <tr>
        <?php
        for ($j = 0; $j <= 15; $j++) {
            ?>
            <td style="width: 40px;height: 40px;position: relative;" id="<?php echo $i;?>_<?php echo $j;?>"
                onclick="press_on(this)">
                <div style="background:#000000;width: 20px;height: 20px;position: absolute;border-radius: 50%;display: none;left: 10px;bottom: 10px"
                    id="div_<?php echo $i;?>_<?php echo $j;?>"></div>
            </td>
        <?php
        }
        }
        ?>

</table>
<script>
    ws = new WebSocket("ws://172.100.0.9:2347");
    ws.onopen = function () {
        // alert("连接成功");
        // ws.send('tom');
        // alert("给服务端发送一个字符串：tom");
    };
    ws.onmessage = function (e) {
        //alert("收到服务端的消息：" + e.data);
        var jsonobj = JSON.parse(e.data);
        if (jsonobj.status == 1 && jsonobj.data.name != null) {//初始化名字
            //alert(jsonobj.data.name);
            $('.player').html(jsonobj.data.name);
        }

        if (jsonobj.status == 2) {//
            if(jsonobj.data.name!=undefined) {
                alert(jsonobj.data.name)
            }
            var type = jsonobj.data.type;
            var press_i = jsonobj.data.press_i;
            var press_j = jsonobj.data.press_j;
            id = '#div_' + press_i + '_' + press_j;
            $(id).css('display', 'block');
            if (type == 1) {
                $(id).css('background', '#000000');
            }
            if (type == 2) {
                $(id).css('background', '#ffbc00');
            }
        }

    }

    function press_on(value) {
        var send = '{"status":2,"data":"' + value.id + '"}';
        ws.send(send);
    }
</script>