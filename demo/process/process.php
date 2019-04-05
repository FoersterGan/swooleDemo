<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/30
 * Time: 22:18
 */
//本节目的在子进程中开启一个http 服务
//可以这么理解process.php 为一个主进程,而$pid为一个子进程
$process=  new swoole_process(function(swoole_process $pro){
    // 相当于php redis.php  exec 执行php文件函数
    //1.首先执行process.php 创建了一个主进程
    //2.该主进程通过swoole_process 创建了子进程
    //3.通过该子进程开启http_server.php 的http服务
    $pro->exec("/usr/local/php/bin/php",[__DIR__.'/../server/http_server.php']);//该程序的进程id正好等于process.php 开启的子进程id
},false);//当这里为true时则不会打印出以上输出

$pid=$process->start();
echo $pid.PHP_EOL;

//结束运行回收子进程     如果不收回子进程则在主进程(process.php)在结束运行时该子进程会持续运行
swoole_process::wait();
