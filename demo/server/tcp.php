<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/25
 * Time: 20:20
 */
//创建Server对象，监听 127.0.0.1:9501端口
/**
 * 该函数有4个参数
 *                 1.连接地址
 *                 2.端口号
 *                 3.运行的模式(多进程模式或者基本模式)
 *                 4.基本模式
 *
 */
$serv = new swoole_server("127.0.0.1", 9501);

$serv->set([
    'worker_num'=>6, //worker 进程数 cpu 核数的1-4 倍
    'max_request'=>10000,//最大的请求数
]);
//监听连接进入事件
/**
 * $reactor_id 线程id
 * $fd 客户端连接的唯一标识
 */
$serv->on('connect', function ($serv, $fd,$reactor_id) {
    echo "Client:{$reactor_id}-{$fd} Connect.\n";
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $reactor_id, $data) {
    $serv->send($fd, "Server: {$reactor_id}##{$fd}".$data);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start();
