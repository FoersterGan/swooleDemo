<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/31
 * Time: 10:28
 */
echo "process-start-time:".date('Ymd H:i:s');
$workers=[];
$urls=[
    'http://baidu.com',
    'http://sina.com.cn',
    'http://qq.com',
    'http://baidu.com?search=singwa',
    'http://baidu.com?search=singwa2',
    'http://baidu.com?search=imooc',
];
/*
 * 同步使用单进程的做法
$content=[];
foreach($urls as $k=>$v)
{
    $content[]=$v;
}
var_dump($content);*/

for($i=0;$i<6;$i++){
    //子进程
    $process=new swoole_process(function(swoole_process $worker)//匿名函数需要使用到闭包

    use($i,$urls){
        //curl
        $content=curlData($urls[$i]);
//        echo $content.PHP_EOL;//因为第三个参数为true，所以该内容不会直接输出到终端中，需要到管道中去进行获取
        $worker->write($content.PHP_EOL);//因为第三个参数为true，所以该内容不会直接输出到终端中，需要到管道中去进行获取
    },true);//当函数体中有内容不会输出，会到管道当中去，管道(进程与进程之间的桥梁)
    //获取子进程id
    $pid=$process->start();
//    var_dump($pid);
//    var_dump($process);
    $workers[$pid] = $process;
}

foreach($workers as $process){
    echo $process->read();     //相当于将管道内的值进行输出,对管道内的值进行读取
}

/**
 * 模拟请求URL的内容 1s
 * @param $url
 * @return string
 */
//foreach($urls as $k=>$v)
//{
//    curlData($v);
//}

function curlData($url){
    //curl file_get_contents;
    sleep(1);
    return $url."success".PHP_EOL;
}
echo "process-end-time:".date('Ymd H:i:s');