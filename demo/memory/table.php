<?php

/**
 * 如果说主进程创建了很多的子进程，但是他们要共享数据的时候就可以使用到该共享内存机制
 */
//当该table.php 进程执行完毕之后该内存会自动进行释放,则就是说该值将不存在
//创建内存表

$table=new swoole_table(1024);//1024代表表格的最大行数

//内存表增加一列
$table->column('id',$table::TYPE_INT);
$table->column('name',$table::TYPE_INT);
$table->column('age',$table::TYPE_INT);
$table->create();

//          singwa_imooc 相当于内存表的表名，也可以叫做key值
$table->set('singwa_imooc',['id'=>1,'name'=>'singwa','age'=>30]);

$table['singwa_imooc_2']=[
    'id'=>2,
    'name'=>'singwa3',
    'age'=>445
];
//print_r($table->get('singwa_imooc_2'));
//print_r($table['singwa_imooc_2']);

//对某个值进行原子操作
    //原子自增操作
//$ret1=$table->incr('singwa_imooc_2','age',2);//会返回当前原子的值
    //原子自减操作
//$ret2=$table->decr('singwa_imooc_2','age',4);

    //删除某一个key
echo 'delete start';
$ret2=$table->del('singwa_imooc_2');
print_r($table['singwa_imooc_2']);

