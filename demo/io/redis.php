<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/29
 * Time: 23:21
 */
$redisClient=new swoole_redis;
$redisClient->connect('127.0.0.1',6379,function($redisClient,$result){
    echo "connect".PHP_EOL;
    var_dump($result);

    //同步redis (new Redis()->set('key',2));
    /*$redisClient->set('singwa_1',time(),function($redisClient,$result){
        var_dump($result);

    });*/
    /*$redisClient->get('singwa_1',function($redisClient,$result){
        var_dump($result);
        $redisClient->close();//不使用了需要close
    });*/
    $redisClient->keys('*gw*',function($redisClient,$result){
        var_dump($result);
        $redisClient->close();
    });
});

echo 'start'.PHP_EOL;