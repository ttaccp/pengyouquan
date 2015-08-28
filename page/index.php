<?php
//!isset($_GET['openid']) && header('Location: https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxb6b25160f0aacad7&redirect_uri=http%3A%2F%2Fsite.hiall.com.cn%2Fliasicawechatredirect%2Fdq%2F%3Findex&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect');
$openid   = $_GET['openid'];
$userInfo = file_get_contents('openids/' . $openid . '.json');
$userInfo = json_decode($userInfo);
?>
<!doctype html>
<html lang="en">
<head>
  <title>德勤内部朋友圈大曝光</title>
  <meta charset="UTF-8"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta http-equiv="Content-Language" content="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0"/>
  <meta name="apple-mobile-web-app-capable" content="yes"/>
  <meta content="telephone=no" name="format-detection"/>
  <link rel="stylesheet" type="text/css" href="../css/base.css"/>
  <link rel="stylesheet" type="text/css" href="../css/index.css"/>

  <link rel="prefetch" href="pwd.html"/>
  <link rel="prefetch" href="groupchat.html"/>
  <link rel="prefetch" href="friend.php?openid=<?php echo $userInfo->openid; ?>"/>
  <link rel="prefetch" href="persondetails.html"/>
  <link rel="prefetch" href="chat.html"/>
  <link rel="prefetch" href="chatlist.html"/>
  <link rel="prefetch" href="pyq.html"/>
  <link rel="prefetch" href="../audio/lock.mp3"/>
  <link rel="prefetch" href="../audio/send.mp3"/>
  <script>
    var _hmt = _hmt || [];
    (function () {
      var hm = document.createElement("script");
      hm.src = "//hm.baidu.com/hm.js?82fbe69f6eddd78e1eb3f7382bb5f3d0";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
  </script>


</head>
<body data-image="<?php echo $userInfo->headimgurl ?>" data-nickname="<?php echo $userInfo->nickname ?>" data-openid="<?php echo $userInfo->openid; ?>">

<div id="step1" class="step1">
  <div class="time">08 : 31</div>
  <div class="date">8月28日&nbsp;&nbsp;&nbsp;&nbsp;星期五</div>

  <div class="msglist" id="msglist">
    <!--<div class="msg ">
      <img src="../img/msg1.png" class="img" />
    </div>-->
  </div>

  <div class="text" id="text">
    <span class="s">〉滑动来解锁</span>
  </div>

</div>

<div class="step2" id="step2"></div>
<div class="step3" id="step3"></div>
<div class="step4" id="step4"></div>
<div class="step5" id="step5"></div>
<div class="step6" id="step6"></div>
<div class="step7" id="step7"></div>

<script src="../js/hammer.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/fastclick.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/jquery-1.8.3.min.js" type="text/javascript" charset="utf-8"></script>
<script src="../js/index.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
  Msg.start();
  $("#step2").load('pwd.html');
</script>
</body>
</html>