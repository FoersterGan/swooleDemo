<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/25
 * Time: 21:05
 */

$client = new swoole_client(SWOOLE_SOCK_UDP);
if(!$client->connect("127.0.0.1",9502))
{
    echo '连接失败';exit;
}
// php 内置cli常量 命令行输入
//STDOUT 标准输出,在执行到该文件时会输出 "请输入消息:"
fwrite(STDOUT,"请输入消息:");
//获取输入的消息
//STDIN :标准输入
$msg=trim(fgets(STDIN));
//发送消息给 tcp server服务器
$client->send($msg);

//接收来自server的数据
$result=$client->recv();
echo $result;