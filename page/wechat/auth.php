<?php
/**
 * Author: liasica
 * CreateTime: 15/8/26 下午9:21
 * Filename: auth.php
 * PhpStorm: pengyouquan
 */
require_once('../helper/WechatHelper.php');
$wechat      = new WechatHelper();
$code        = $_GET['code'];
$userInfo    = $wechat->getInfo($code);
$from_openid = $_GET['from_openid'];
$to_openid   = $userInfo->openid;
if ($from_openid != null && $to_openid != null)
{
  // 插入数据
  //$url   = '../friend.php?openid=' . $userInfo->openid;
  $url   = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb6b25160f0aacad7&redirect_uri=http%3A%2F%2Fsite.hiall.com.cn%2Fliasicawechatredirect%2Fdq%2F&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
  $check = $wechat->getStatusByOpenid($userInfo->openid);
  if ($check)
  {
    header('Location: ' . $url);
  }
  else
  {
    $sql = 'INSERT INTO dq_pyq (from_openid, to_openid, created) VALUES (\'' . $from_openid . '\', \'' . $to_openid . '\', ' . time() . ')';
    $s   = $wechat->Insert($sql);
    if ($s)
    {
      header('Location: ' . $url);
    }
  }
}