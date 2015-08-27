<?php
/**
 * Author: liasica
 * CreateTime: 15/8/27 下午2:54
 * Filename: tj.php
 * PhpStorm: pengyouquan
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
require_once(__DIR__ . '/../helper/WechatHelper.php');
$wechat = new WechatHelper();
$name = $_GET['name'];
$value = $wechat->clickTeacher($name);
if ($value)
{
  $wechat->renderJson(array(
    'state' => 200
  ));
}
else
{
  $wechat->renderJson(array(
    'state' => '500'
  ));
}