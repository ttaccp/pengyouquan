<?php
/**
 * Author: liasica
 * CreateTime: 15/8/26 下午9:59
 * Filename: index.php
 * PhpStorm: pengyouquan
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
require_once(__DIR__ . '/../helper/WechatHelper.php');
$wechat = new WechatHelper();
$openid = $_GET['openid'];
$status = false;
if ($openid != null)
{
  $status = $wechat->getStatusByOpenid($openid);
  //while (!$status)
  //{
  //  $status = $wechat->getStatusByOpenid($openid);
  //  sleep(1);
  //}
}
echo json_encode(array('state' => $status));