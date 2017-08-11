<?php

header('Content-type: text/html; charset=UTF8');

error_reporting(E_ALL | ~E_NOTICE | ~E_WARNING);

require 'autoload.php';

// 实例化一个留言(此处用来模拟前端页面获取的留言)
$msg = new Message();
$msg->name = 'xxxxxx';
$msg->email = 'xxxxxx@gmail.com';
$msg->content = date('Y-m-d H:i:s').'：今天天气不错，一起出去玩，可好？';

// 留言操作装饰,用来执行写留言功能
$msgDecorate = new MsgDecorate();

// 留言本的操作类
$msgBox = new MsgBox();
$msgBox->setBookPath('messages.txt');

// 用户管理留言的类
$user = new MsgManager();
$user->write($msgDecorate, $msgBox, $msg); // 添加一条留言
// $user->delete($msgBox); // 删除全部留言
// echo $user->view($msgBox); // 显示全部留言
echo $user->viewByPage($msgBox, 4); // 分页显示留言
