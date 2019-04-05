<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/2/1
 * Time: 19:07
 */

$http = new swoole_http_server('0.0.0.0',8001);

$http->on('request',function($request,$response){
    //获取redis里面的 key内容，然后输出到浏览器中

    $redis = new Swoole\Coroutine\Redis();
    $redis->connect('127.0.0.1',6379);
    $value= $redis->get($request->get['a']);

    // mysql

    // time =（redis,mysql)
    $response->header("Content-Type","text/plain");
    $response->end($value);
});
$http->start();

/**
 *协程 client 特性
 *传统同步情况下获取数据
 * 1 redis
 * 2 mysql
 * io网络时间总和=1+2
 *而使用swoole 协程则 是在mysql 和 redis 中去获取一个时间处理最大值完成该工作
 *
 *
 */