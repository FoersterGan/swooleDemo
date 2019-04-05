<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/26
 * Time: 10:37
 */
/**
 * 可以写0.0.0.0 代表监听所有地址
 */
$http = new swoole_http_server("0.0.0.0",8811);
/**
 * 第一个参数代表请求的内容,$request 获取浏览器的请求信息
 * 第二个参数代表响应的内容,$response 获取响应信息
 */
$http->set(
    [
        'enable_static_handler'=>true,
        'document_root'=>"/home/swoole/demo/view", //设置视图页面
        //worker 进程数 cpu 核数的1-4 倍,启动swoole的http服务会默认启动worker进程
        //也可以说在swoole 的http服务是启动了worker进程
        'worker_num'=>6,
    ]
);

$http->on('request',function($request,$response){
    $content=[
        'date:'=>date('Ymd H:i:s'),
        'get:'=>$request->get,
        'post:'=>$request->post,
        'header:'=>$request->header
    ];
    swoole_async_writefile(__DIR__.'/access.log',json_encode($content).PHP_EOL,function($filename){

    },FILE_APPEND);
    $response->cookie("wangqian","woain",5200);
    $response->end("sss".json_encode($request->get));
});

$http->start();