<?php
/**
 * Author: liasica
 * CreateTime: 15/8/26 下午8:24
 * Filename: WechatHelper.php
 * PhpStorm: pengyouquan
 */
require_once __DIR__ . '/Config.php';

class WechatHelper
{
  private $db;
  private $host;
  private $username;
  private $password;
  private $conn;
  private $appId = 'wxb6b25160f0aacad7';
  private $appSecret = '6fff7fda51bea8c8d1bbf0c89b805f17';
  private $file = __DIR__ . '/../jssdk/code_token.json';

  public function __construct()
  {
    $config         = new Config();
    $this->db       = $config->db;
    $this->username = $config->username;
    $this->password = $config->password;
    $this->host     = $config->host;
    $this->conn     = mysqli_init();
    if (!$this->conn)
    {
      die('连接数据库初始化失败');
    }
    if (!$this->conn->real_connect($this->host, $this->username, $this->password, $this->db))
    {
      exit($this->conn->connect_error);
    }
    if (!$this->file)
    {
      @file_put_contents($this->file, '');
    }
    elseif (!is_writable($this->file))
    {
      @chown($this->file, 'apache:apache');
      @chmod($this->file, 777);
    }
    $this->conn->set_charset('utf8');
  }

  /**
   * @param $data
   */
  public static function dump($data)
  {
    echo '<pre>';
    var_dump($data);
    echo '<pre>';
  }

  /**
   * 获取openid数据
   *
   * @param $openid
   *
   * @return array
   */
  public function getDatasByOpenid($openid)
  {
    $sql = 'SELECT * FROM dq_pyq WHERE from_openid=\'' . $openid . '\'OR to_openid=\'' . $openid . '\'';

    return $this->fetchArrObj($sql);
  }

  /**
   * @param $name
   *
   * @return array
   */
  public function getTeacher($name)
  {
    $sql = 'SELECT * FROM dq_teacher WHERE teacher=\'' . $name . '\'';

    return $this->fetchArrObj($sql);
  }

  public function clickTeacher($name)
  {
    $teacher = $this->getTeacher($name);
    if (count($teacher) < 1)
    {
      $sql = 'INSERT INTO dq_teacher (teacher, times) VALUES (\'' . $name . '\', ' . 1 . ')';
    }
    else
    {
      $times = $teacher[0]->times;
      $times += 1;
      $sql = 'UPDATE dq_teacher SET times=' . $times . ' WHERE teacher=\'' . $name . '\'';
    }

    return $this->Insert($sql);
  }

  /**
   * @param $name
   * @param $msg
   *
   * @return bool|\mysqli_result
   */
  public function saveComment($name, $msg)
  {
    $sql = sprintf('INSERT INTO dq_msg (name, msg, created) VALUES (\'%s\', \'%s\', %s)', $name, $msg, time());

    return $this->Insert($sql);
  }

  /**
   * 返回状态
   *
   * @param $openid
   *
   * @return bool
   */
  public function getStatusByOpenid($openid)
  {
    $count = count($this->getDatasByOpenid($openid));
    if ($count > 0)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  /**
   * @param $sql
   *
   * @return array
   */
  public function fetchArrObj($sql)
  {
    $arr    = array();
    $result = $this->conn->query($sql);
    while ($obj = $result->fetch_object())
    {
      $arr[] = $obj;
    }

    return $arr;
  }

  /**
   * @param $url
   *
   * @return mixed
   */
  public function cURL($url)
  {
    //初始化
    $ch = curl_init();
    //设置选项，包括URL
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //执行并获取HTML文档内容
    $output = curl_exec($ch);
    curl_close($ch);

    return $output;
  }

  /**
   * @param $url
   *
   * @return string
   */
  public function getCodeUrl($url)
  {
    $url = urlencode($url);
    $res = sprintf('https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect', $this->appId, $url);

    return $res;
  }

  /**
   * @param $code
   *
   * @return string
   */
  public function getTokenUrl($code)
  {
    $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';

    return sprintf($url, $this->appId, $this->appSecret, $code);
  }

  /**
   * @param $code
   *
   * @return mixed
   */
  public function getAccessToken($code)
  {
    //$str = file_get_contents($this->file);
    //$obj = json_decode($str);
    //if ($obj->created + 3600 < time())
    //{
    //  $url          = $this->getTokenUrl($code);
    //  $res          = $this->cURL($url);
    //  $obj          = json_decode($res);
    //  $obj->created = time();
    //  file_put_contents($this->file, json_encode($obj));
    //}
    $url = $this->getTokenUrl($code);
    $res = $this->cURL($url);
    $obj = json_decode($res);

    return $obj;
  }

  /**
   * @param $code
   *
   * @return mixed
   */
  public function getInfo($code)
  {
    $obj = $this->getAccessToken($code);
    $url = sprintf('https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN', $obj->access_token, $obj->openid);
    $res = $this->cURL($url);

    return json_decode($res);
  }

  /**
   * @param $data
   */
  public function renderJson($data)
  {
    echo json_encode($data);
  }

  /**
   * @param $sql
   *
   * @return bool|\mysqli_result
   */
  public function Insert($sql)
  {
    return $this->conn->query($sql);
  }
}