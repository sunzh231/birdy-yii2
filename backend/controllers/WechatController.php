<?php
namespace backend\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\Cors;
use common\models\Channel;
use common\models\Fans;
use common\utils\Weconnect;
use common\utils\Jssdk;
use common\utils\Curl;

class WechatController extends ActiveController
{
  public $modelClass = '';
  public function behaviors()
  {
    $behaviors = parent::behaviors();
    $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
    $behaviors['corsFilter'] = [
      'class' => Cors::className(),
      'cors' => [
        'Origin' => ['*'],
        'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
        'Access-Control-Request-Headers' => ['*'],
        'Access-Control-Allow-Credentials' => true,
        'Access-Control-Max-Age' => 86400,
      ],
    ];
    return $behaviors;
  }
  public function actionValid()
  {
    $request = Yii::$app->request;
    switch ($request->getMethod()) {
      case 'GET':
        $params = $request->get();
        if (Weconnect::checkSignature($params['signature'], $params['timestamp'], $params['nonce'])) {
          echo $params['echostr'];
        }
        break;
      case 'POST':
        $this->responseMsg();
        break;
      default:
        throw new NotFoundHttpException('The requested page does not exist.');
    }
  }

  public function actionConfig()
  {
    // $params = Yii::$app->request->post();
    $params = [
      'appid' => 'wxbf0b5a6d2e30a4d3',
      'appsecret' => 'a50c9b7a5524a2626f29d33502098486'
    ];
    return Jssdk::getSignPackage($params['appid'], $params['appsecret']);
  }

  private function responseMsg()
  {
    // $postStr = $GLOBALS["HTTP_RAW_POST_DATA"]; //PHP5有效
    $postStr = file_get_contents("php://input"); //PHP7有效
    if (!empty($postStr)) {
      libxml_disable_entity_loader(true);
      $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
      // $fromUsername = $postObj->FromUserName;
      $toUsername = $postObj->ToUserName;
      $RX_TYPE = trim($postObj->MsgType);
      switch ($RX_TYPE)
      {
        case "text":
          $resultStr = $this->receiveText($postObj);
          break;
        case "image":
          $resultStr = $this->receiveImage($postObj);
          break;
        case "location":
          $resultStr = $this->receiveLocation($postObj);
          break;
        case "voice":
          $resultStr = $this->receiveVoice($postObj);
          break;
        case "video":
          $resultStr = $this->receiveVideo($postObj);
          break;
        case "link":
          $resultStr = $this->receiveLink($postObj);
          break;
        case "event":
          $resultStr = $this->receiveEvent($postObj);
          break;
        default:
          $resultStr = "unknow msg type: ".$RX_TYPE;
          break;
      }
      echo $resultStr;
    } else {
      echo "";
      exit;
    }
  }
  //接收文本消息
  private function receiveText($object)
  {
    $keyword = trim($object->Content);
    $contentStr = "Welcome to wechat world!";
    if (is_array($contentStr)){
      $resultStr = Weconnect::transmitNews($object, $contentStr);
    }else{
      $resultStr = Weconnect::transmitText($object, $contentStr);
    }
    return $resultStr;
  }
  //接收事件，关注等
  private function receiveEvent($object)
  {
    $contentStr = "";
    switch ($object->Event)
    {
      case "subscribe":
        $model = Channel::findOne(['originid' => $object->ToUserName]);
        $access_token = Weconnect::getAccessToken($model->appid, $model->appsecret);
        $userInfo = Weconnect::getUserInfo($object->FromUserName, $access_token->access_token);
        $fans = Fans::findOne(['openid' => $object->FromUserName]);
        if (!$fans) {
          $fans = new Fans();
        }
        $fans->nickname = $userInfo->nickname;
        $fans->headimgurl = $userInfo->headimgurl;
        $fans->openid = $userInfo->openid;
        $fans->unionid = $userInfo->unionid;
        $fans->sex = $userInfo->sex;
        $fans->language = $userInfo->language;
        $fans->city = $userInfo->city;
        $fans->province = $userInfo->province;
        $fans->country = $userInfo->country;
        $fans->subscribe = $userInfo->subscribe;
        $fans->subscribe_time = $userInfo->subscribe_time;
        $fans->remark = $userInfo->remark;
        $fans->tagid_list = '';
        $fans->updated_by = 1;
        $fans->created_by = 1;
        if (!$fans->save()) {
            return false;
        }
        $contentStr = Weconnect::transmitNews($object, "欢迎关注！");
        break;
      case "unsubscribe":
        $contentStr = "你取消了关注";
        break;
      case "CLICK":
        $contentStr =  $this->receiveClick($object);    //点击事件
        break;
      default:
        $contentStr = "receive a new event: ".$object->Event;
        break;
    }
    return $contentStr;
  }
  //点击菜单消息
  private function receiveClick($object)
  {
    switch ($object->EventKey)
    {
      case "1":
        $contentStr = "猫咪酱个性DIY服装，我们专业定制个性【班服，情侣装，亲子装等，有长短T恤，卫衣，长短裤】来图印制即可，给你温馨可爱的TA，有事可直接留言微信";
        break;
      case "2":
        $contentStr = "你点击了菜单: ".$object->EventKey;
        break;
      case "3":
        $contentStr = "是傻逼";
        break;
      default:
        $contentStr = "你点击了菜单: ".$object->EventKey;
        break;
    }
     //两种回复
    if (is_array($contentStr)){
      $resultStr = Weconnect::transmitNews($object, $contentStr);
    }else{
      $resultStr = Weconnect::transmitText($object, $contentStr);
    }
    return $resultStr;
  }
  //接收图片
  private function receiveImage($object)
  {
    $contentStr = "你发送的是图片，地址为：".$object->PicUrl;
    $resultStr = Weconnect::transmitText($object, $contentStr);
    return $resultStr;
  }
  //接收语音
  private function receiveVoice($object)
  {
    $contentStr = "你发送的是语音，媒体ID为：".$object->MediaId;
    $resultStr = Weconnect::transmitText($object, $contentStr);
    return $resultStr;
  }
  //接收视频
  private function receiveVideo($object)
  {
    $contentStr = "你发送的是视频，媒体ID为：".$object->MediaId;
    $resultStr = Weconnect::transmitText($object, $contentStr);
    return $resultStr;
  }
  //位置消息
  private function receiveLocation($object)
  {
    $contentStr = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".$object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
    $resultStr = Weconnect::transmitText($object, $contentStr);
    return $resultStr;
  }
  //链接消息
  private function receiveLink($object)
  {
    $contentStr = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
    $resultStr = Weconnect::transmitText($object, $contentStr);
    return $resultStr;
  }
}
