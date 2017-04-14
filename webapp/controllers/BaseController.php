<?php
namespace webapp\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\utils\Curl;

class BaseController extends ActiveController
{
  // /**
  // * GET
  // */
  // public function getAccessToken() {
  //   $curl = new Curl;
  //   $AppId = 'wx46a8d31ccf5a0d32';
  //   $AppSecret = '465e626250bff7fc0454341b338d41c9';
  //   $getUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$AppId.'&secret='.$AppSecret;
  //   return $curl->Get($getUrl);
  // }
}
