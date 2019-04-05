<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/26
 * Time: 16:20
 */

class ws
{
    CONST HOST = "0.0.0.0";
    CONST PORT = 8812;
    public $ws = null;
    public function __construct()
    {
        $this->ws = new swoole_websocket_server(ws::HOST, ws::PORT);
        $this->ws->set(
            [
                'worker_num'=>2,
                'task_worker_num'=>2,
                'document_root'=>"/home/swoole/demo/view", //设置视图页面
                'enable_static_handler'=>true,
            ]
        );
        $this->ws->on("open",[$this,'onOpen']);
        $this->ws->on("message",[$this,'onMessage']);
        $this->ws->on("task",[$this,'onTask']);//异步
        $this->ws->on("finish",[$this,'onFinish']);
        $this->ws->on("close",[$this,'onClose']);
        $this->ws->start();
    }

    /**
     * 监听ws链接事件
     * @param $ws
     * @param $request  $request->fd为客户端id
     */
    public function onOpen($ws,$request)
    {
        var_dump($request->fd.'我是客户端id');
        if($request->fd==2){
            //每2秒执行                     //$timerId 指的是定时器id
            swoole_timer_tick(2000,function($timerId){
                echo "2s:timerId:{$timerId}\n";
            });

        }

    }

    /**
     * 监听wa消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws,$frame)
    {
        echo "Message: {$frame->data}\n";
        //todo 10s
        $data=[
            'task'=>1,
            'fd'=>$frame->fd
        ];
        $ws->task($data);
        swoole_timer_after(5000,function() use($ws,$frame){
            echo "5s-after\n";
            $ws->push($frame->fd,"server-time-after:");
        });
        $ws->push($frame->fd,"server:我这里是服务端我给你回话了".date("Y-m-d H:i:s"));
    }

    /**
     * @param $ws
     * @param $taskId
     * @param $workerId
     * @param $data    此处data为onMessage 中传递的$data
     */
    public function onTask($ws,$taskId,$workerId,$data)
    {
        print_r($data);
        //耗时场景 10s
        sleep(10);
        return "on task finish";// 告诉worker
    }

    /**
     * @param $serv
     * @param $taskId
     * @param $data  此处data为onTask 中传递return 返回的 字符串
     */
    public function onFinish($serv,$taskId,$data)
    {
        echo "taskId:{$taskId}\n";
        echo "finish-data-sucess:{$data}\n";
    }
    /**
     * 关闭
     * @param $ws
     * @param $fd
     */
    public function onClose($ws,$fd)
    {
        echo "client-{$fd} is closed\n";
    }
}

$obj=new ws();