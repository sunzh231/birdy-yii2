<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\Cors;
use common\models\Channel;

class WechatController extends ActiveController
{
  public $modelClass = 'common\models\Channel';

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
        if ($this->checkSignature($params['signature'], $params['timestamp'], $params['nonce'])) {
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

  private function checkSignature($signature, $timestamp, $nonce)
  {
    $token = 'weixin';
    $tmpArr = array($token, $timestamp, $nonce);
    // use SORT_STRING rule
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );

    if($tmpStr == $signature) {
        return true;
    } else {
        return false;
    }
  }

  private function responseMsg()
  {
    //get post data, May be due to the different environments
    // $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    // if (!empty($postStr)) {
    //   libxml_disable_entity_loader(true);
    //   $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
    //   $fromUsername = $postObj->FromUserName;
    //   $toUsername = $postObj->ToUserName;
    //   $RX_TYPE = trim($postObj->MsgType);
    //   switch ($RX_TYPE)
    //   {
    //     case "text":
    //       $resultStr = $this->receiveText($postObj);
    //       break;
    //     case "image":
    //       $resultStr = $this->receiveImage($postObj);
    //       break;
    //     case "location":
    //       $resultStr = $this->receiveLocation($postObj);
    //       break;
    //     case "voice":
    //       $resultStr = $this->receiveVoice($postObj);
    //       break;
    //     case "video":
    //       $resultStr = $this->receiveVideo($postObj);
    //       break;
    //     case "link":
    //       $resultStr = $this->receiveLink($postObj);
    //       break;
    //     case "event":
    //       $resultStr = $this->receiveEvent($postObj);
    //       break;
    //     default:
    //       $resultStr = "unknow msg type: ".$RX_TYPE;
    //       break;
    //   }
    //   echo $resultStr;
    // } else {
    //   echo "";
    //   exit;
    // }
    echo "";
  }

  //接收文本消息
  private function receiveText($object)
  {
    $keyword = trim($object->Content);
    $contentStr = "Welcome to wechat world!";
    if (is_array($contentStr)){
      $resultStr = $this->transmitNews($object, $contentStr);
    }else{
      $resultStr = $this->transmitText($object, $contentStr);
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
        $contentStr = "你关注了我";    //关注后回复内容
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

  //接收图片
  private function receiveImage($object)
  {
    $contentStr = "你发送的是图片，地址为：".$object->PicUrl;
    $resultStr = $this->transmitText($object, $contentStr);
    return $resultStr;
  }


  //接收语音
  private function receiveVoice($object)
  {
    $contentStr = "你发送的是语音，媒体ID为：".$object->MediaId;
    $resultStr = $this->transmitText($object, $contentStr);
    return $resultStr;
  }

  //接收视频
  private function receiveVideo($object)
  {
    $contentStr = "你发送的是视频，媒体ID为：".$object->MediaId;
    $resultStr = $this->transmitText($object, $contentStr);
    return $resultStr;
  }

  //位置消息
  private function receiveLocation($object)
  {
    $contentStr = "你发送的是位置，纬度为：".$object->Location_X."；经度为：".$object->Location_Y."；缩放级别为：".$object->Scale."；位置为：".$object->Label;
    $resultStr = $this->transmitText($object, $contentStr);
    return $resultStr;
  }

  //链接消息
  private function receiveLink($object)
  {
    $contentStr = "你发送的是链接，标题为：".$object->Title."；内容为：".$object->Description."；链接地址为：".$object->Url;
    $resultStr = $this->transmitText($object, $contentStr);
    return $resultStr;
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
      $resultStr = $this->transmitNews($object, $contentStr);
    }else{
      $resultStr = $this->transmitText($object, $contentStr);
    }
    return $resultStr;
  }

  //回复文本消息
  private function transmitText($object, $content)
  {
    $textTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[text]]></MsgType>
    <Content><![CDATA[%s]]></Content>
    </xml>";
    $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
    return $resultStr;
  }

  //回复图文
  private function transmitNews($object, $arr_item)
  {
    if(!is_array($arr_item))
      return;
    $itemTpl = "<item>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <PicUrl><![CDATA[%s]]></PicUrl>
      <Url><![CDATA[%s]]></Url>
      </item>";
    $item_str = "";
    foreach ($arr_item as $item)
      $item_str .= sprintf($itemTpl, $item['Title'], $item['Description'], $item['PicUrl'], $item['Url']);

   $newsTpl = "<xml>
    <ToUserName><![CDATA[%s]]></ToUserName>
    <FromUserName><![CDATA[%s]]></FromUserName>
    <CreateTime>%s</CreateTime>
    <MsgType><![CDATA[news]]></MsgType>
    <Content><![CDATA[]]></Content>
    <ArticleCount>%s</ArticleCount>
    <Articles>$item_str</Articles>
    </xml>";
    $resultStr = sprintf($newsTpl, $object->FromUserName, $object->ToUserName, time(), count($arr_item));
    return $resultStr;
  }

  //音乐消息
  private function transmitMusic($object, $musicArray, $flag = 0)
  {
    $itemTpl = "<Music>
      <Title><![CDATA[%s]]></Title>
      <Description><![CDATA[%s]]></Description>
      <MusicUrl><![CDATA[%s]]></MusicUrl>
      <HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
      </Music>";
    $item_str = sprintf($itemTpl, $musicArray['Title'], $musicArray['Description'], $musicArray['MusicUrl'], $musicArray['HQMusicUrl']);
    $textTpl = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[music]]></MsgType>
      $item_str
      <FuncFlag>%d</FuncFlag>
      </xml>";
    $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $flag);
    return $resultStr;
  }
}
