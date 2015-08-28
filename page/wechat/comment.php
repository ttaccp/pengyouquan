<?php
/**
 * Author: liasica
 * CreateTime: 15/8/28 上午10:24
 * Filename: comment.php
 * PhpStorm: pengyouquan
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
require_once(__DIR__ . '/../helper/WechatHelper.php');
$wechat = new WechatHelper();
$msg    = $_GET['msg'];
$name   = $_GET['name'];
if ($name != null && $msg != null)
{
  if ($wechat->saveComment($name, $msg))
  {
    $wechat->renderJson(array('state' => 200));
  }
  else
  {
    $wechat->renderJson(array('state' => 1001, 'message' => '保存失败'));
  }
}