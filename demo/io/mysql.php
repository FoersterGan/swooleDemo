<?php
/**
 * Created by PhpStorm.
 * User: loveLinux
 * Date: 2019/1/29
 * Time: 14:25
 */

class AysMysql
{
    public $dbSource = "";
    public $dbConfig = [];
    public function __construct()
    {
        //new swoole_mysql;
        $this->dbSource=new Swoole\Mysql;
        $this->dbConfig=[
            'host' => '47.106.72.138',
            'port' => 3306,
            'user' => 'xuyang',
            'password' => 'dadangjia123',
            'database' => 'swoole',
            'charset' => 'utf8', //指定字符集
        ];
    }

    public function update()
    {

    }
    public function add()
    {

    }

    /**
     * mysql 执行逻辑
     * @param $id
     * @param $username
     */
    public function execute($id,$username)
    {
        //connect 进行mysql 链接
        //返回两个参数
        //$db    $result 链接成功返回一个布尔值                           use 闭包可以将外层的参数传入
        $this->dbSource->connect($this->dbConfig,function($db,$result) use ($id,$username){
            echo "mysql-connect".PHP_EOL;
            if($result===false){
                var_dump($db->connect_error);
            }

//            $sql="select * from test where id=1";
            $sql="update test set `username` = '".$username."'where id=".$id;
            // 使用query方法 (add delete update select)
            /**
             * $db  链接信息
             * $result  执行sql后的返回值
             */
            $db->query($sql,function($db,$result){
                //select => result 返回的是查询的结果集
                //add  update delete 返回的是布尔类型
                if($result===false){
                    var_dump($db->error);
                }elseif($result===true){//add update delete
                    //todo
                    var_dump($db->affected_rows);
                }else{
                    print_r($result);
                }
                //执行链接完成后需要执行close 关闭mysql链接的方法
                $db->close();
            });
        });
        return true;
    }
}
$obj=new AysMysql();
$flag=$obj->execute(1,'sinwa-111');
var_dump($flag).PHP_EOL;
echo "start".PHP_EOL;
//该异步的提现在首先执行的是打印操作，然后再执行执行update操作，也就是说update 和 select 并不互相干扰
//详情页 ->mysql (阅读数) ->mysql 文章 +1 ->页面数据呈现出来