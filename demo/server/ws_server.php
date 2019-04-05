<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/26
 * Time: 15:27
 */
//创建websocket服务器对象，监听0.0.0.0:9502端口
$server = new swoole_websocket_server("0.0.0.0", 8812);

$server->set(
    [
        'enable_static_handler'=>true,
        'document_root'=>"/home/swoole/demo/view", //设置视图页面
    ]
);
//监听WebSocket连接打开事件
//$ws->on('open', function ($ws, $request) {
//    var_dump($request->fd, $request->get, $request->server);
//    $ws->push($request->fd, "hello, welcome\n");
//});
//监听WebSocket连接打开事件
$server->on('open','onOpen');
function onOpen($server,$request){
    print_r($request->fd);
}
//监听WebSocket消息事件(接收消息，同时通过push发送消息)
$server->on('message', function ($server, $frame) {
    echo "Message: {$frame->data}\n";
    $server->push($frame->fd, "server: {$frame->data} 服务端:你好我是服务端");//向服务端返回的消息
});

//监听WebSocket连接关闭事件 fd代表客户端端号
$server->on('close', function ($server, $fd) {
    echo "client-{$fd} is closed\n";
});

$server->start();