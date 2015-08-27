<?php
/**
 * Author: liasica
 * CreateTime: 15/8/27 上午7:12
 * Filename: sortUrl.php
 * PhpStorm: pengyouquan
 */
$auth  = $_GET['auth'];
$url = 'http://site.hiall.com.cn/liasicawechatredirect/dq/?auth=' . $auth;
$url = urlencode($url);
$value = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb6b25160f0aacad7&redirect_uri=' . $url . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
header('Location: ' . $value);
