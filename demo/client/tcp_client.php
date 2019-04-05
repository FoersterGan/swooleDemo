<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/25
 * Time: 21:05
 */
// 连接 swoole tcp 服务
$client = new swoole_client(SWOOLE_SOCK_TCP);

if(!$client->connect("127.0.0.1",9501))
{
    echo '连接失败';exit;
}
// php 内置cli常量
fwrite(STDOUT,"请输入消息");
$msg=trim(fgets(STDIN));
//发送消息给 tcp server服务器
$client->send($msg);

//接收来自server的数据
$result=$client->recv();
echo $result;



