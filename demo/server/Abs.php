<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/26
 * Time: 17:33
 */
class Abs
{
    CONST HOST = "0.0.0.0";
    CONST PORT = 8811;
    public $http = null;
    public function __construct()
    {
        $this->http = new swoole_http_server("0.0.0.0",8813);
        $this->http->set(
            [
                'worker_num'=>2,
                'task_worker_num'=>2
            ]
        );
        $this->http->on("request",[$this,"onRequest"]);
        $this->http->on("task",[$this,'onTask']);
        $this->http->on("finish",[$this,'onFinish']);
        $this->http->start();
    }

    public function onRequest($request,$response)
    {


        //TODO 10s
        $array=[
            'name'=>'xiaolongbao',
            'sex'=>'woman'
        ];
        $this->http->task($array);

        $response->end("<h1>chu lai ba pi ka qiu</h1>");
    }

    public function onTask($array)
    {

        //耗时场景 10s
        sleep(10);
        return "on task finish";// 告诉worker
    }

    /**
     * @param $serv
     * @param $taskId
     * @param $array
     */
    public function onFinish($serv,$taskId,$array)
    {
        echo $array;
    }
}
$obj=new Abs();