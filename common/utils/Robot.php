<?php
namespace common\utils;

use common\utils\Curl;

class Robot
{
  public static function getUUID($appid)
  {
    $params = ['appid' => $appid];
    $getUrl = 'https://login.weixin.qq.com/jslogin';
    $curl = new Curl;
    return $curl->GetStr($getUrl, $params);
  }

  public static function showQrCode($uuid)
  {
    $params = ['t' => 'webwx', '_' => time()];
    $postUrl = 'https://login.weixin.qq.com/qrcode/'.$uuid;
    $curl = new Curl;
    return $curl->Post($postUrl, $params);
  }

  public static function waitForLogin($tip, $uuid)
  {
    // tip : 1:未扫描 0:已扫描
    // uuid : 获取到的uuid
    // _ : 时间戳
    $params = ['tip' => $tip, 'uuid' => $uuid, '_' => time()];
    $getUrl = 'https://login.weixin.qq.com/cgi-bin/mmwebwx-bin/login';
    $curl = new Curl;
    return $curl->Get($getUrl, $params);
  }
}
