<?php

$content = date("Ymd H:i:s");
 swoole_async_writefile(__DIR__."/2.log",$content,function
    ($filename){
        echo "success".PHP_EOL;
    },FILE_APPEND);


//file_put_contents();情况很类似
echo "start".PHP_EOL;