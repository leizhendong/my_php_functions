<?php
/**
 * 函数使用实例
 */

require './helpers.php';
echo '<pre>';

$time=time();
// 原数据
$order_list=[
	['id'=>1, 'is_pay'=>1, 'is_receipt'=>0, 'paytime'=>$time],
	['id'=>2, 'is_pay'=>1, 'is_receipt'=>1, 'paytime'=>$time],
	['id'=>3, 'is_pay'=>0, 'is_receipt'=>0, 'paytime'=>$time],
];
//规则
$arr=[
    'paytime'=>'Y-m-d H:i:s',
	'is_pay'=>['0'=>'未支付','1'=>'已支付'],
    'is_receipt'=>['0'=>'未发货','1'=>'已发货'],
];

// 替换后写入到原字段
replace_value($order_list,$arr);
//print_r($order_list);

//替换后写入到新字段
replace_value($order_list,$arr,"_html");
//print_r($order_list);


