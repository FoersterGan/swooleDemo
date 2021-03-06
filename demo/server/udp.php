<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/26
 * Time: 9:41
 */

//创建Server对象，监听 127.0.0.1:9502端口，类型为SWOOLE_SOCK_UDP
$serv = new swoole_server("127.0.0.1", 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

//监听数据接收事件
$serv->on('Packet', function ($serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
    var_dump($clientInfo);
    //会打印出的参数
        /**
         * 1.server_socket 3
         * 2.server_port   9502      //启动的服务端的端口
         * 3.address       127.0.0.1 //服务端链接地址
         * 4.port          55634     //进程号
         */
});

//启动服务器
$serv->start();