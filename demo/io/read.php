<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/27
 * Time: 14:09
 */
/**
 * 读取文件
 */
//$result=swoole_async_readfile(__DIR__."/1.txt",function($filename,$fileContent){
//    echo "filename:".$filename.PHP_EOL;
//    echo "content:".$fileContent.PHP_EOL;
//});
//命名空间风格
$result=Swoole\Async::readFile(__DIR__."/1.txt",function($filename,$fileContent){
    echo "filename:".$filename.PHP_EOL;
    echo "content:".$fileContent.PHP_EOL;
});
var_dump($result);//文件存在为true ，文件不存在为false
//因为是异步所以，先执行下面的程序
echo "start".PHP_EOL;



