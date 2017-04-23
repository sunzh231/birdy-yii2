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
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    if (!empty($postStr)) {
      libxml_disable_entity_loader(true);
      $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
      $RX_TYPE = trim($postObj->MsgType);
      switch ($RX_TYPE)
      {
          case "text":
              $resultStr = "";
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

  private function getAccessToken()
  {
      $config = Wechat::find()->one();
      $params = ['appid' => $config->appid, 'secret' => $config->appsecret];
      $getUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential';
      $curl = new Curl;
      return $curl->Get($getUrl, $params);
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
              $member = Member::find()->where(['open_id' => $object->FromUserName])->one();
              if ($member) {
                $contentStr = $this->transmitText($object, '欢迎重新回到天天集结号！');
              } else {
                $superiorId = substr($object->EventKey, 8);
                pclose(popen("php /www/birdy-dev/api-server/yii wechat/index ".$object->FromUserName." ".$superiorId ,'r'));
              }
              break;
          case "unsubscribe":
              $contentStr = "你取消了关注";
              break;
          case "SCAN":
              $contentStr = "";
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
          case "qr":
              $member = Member::find()->where(['open_id' => $object->FromUserName])->one();
              if($member && $member->qr && $member->level > 0) {
                $resultStr = $this->transmitImage($object, $member->qr);
              } else {
                $resultStr = $this->transmitText($object, '请进入战场，雇佣任意军衔的士兵一名，就可以领取您的专属二维码了');
              }
              break;
          case "image":
              $contentStr = "你点击了菜单: ".$object->EventKey;
              $resultStr = $this->transmitText($object, $contentStr);
              break;
          default:
              $contentStr = "你点击了菜单: ".$object->EventKey;
              $resultStr = $this->transmitText($object, $contentStr);
              break;
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

  //回复文本消息
  private function transmitImage($object, $mediaId)
  {
      $textTpl = "<xml>
      <ToUserName><![CDATA[%s]]></ToUserName>
      <FromUserName><![CDATA[%s]]></FromUserName>
      <CreateTime>%s</CreateTime>
      <MsgType><![CDATA[image]]></MsgType>
      <Image>
      <MediaId><![CDATA[%s]]></MediaId>
      </Image>
      </xml>";
      $resultStr = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $mediaId);
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

  private function sendImage()
  {
      $curl = new Curl;
      $accessToken = $this->getAccessToken();
      $url = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$accessToken->access_token;
      $parmas = ["touser" => "o9A__wys6q0Be8TbCaf2tzMklaRM", "msgtype" => "image", "image" => ["media_id"=>"3JA8AWLxM3v05HRKTZO1Kl5iUFktLOPJxwhylnVuxro"]];
      $curl->Post($url, $parmas);
  }

  public function actionPacket()
  {
      if (!Yii::$app->user->isGuest) {
        $params = Yii::$app->request->post();

        $member = Member::find()->where(['open_id' => $params['open_id']])->one();
        if ($member->balance < $params['count']) {
          return ['code' => -1, 'msg' => '用户余额不足，请慎重操作！'];
        }

        $config = Wechat::find()->one();
        if ($config) {
          $mch_billno = $config->account.date('YmdHis').rand(1000, 9999);
          $nonce_str = $this->create_nonce_str(32);
          // return ['params' => $params, 'mch_billno' => $mch_billno];
          $send_array = array(
              'act_name' => "天天集结号现金提取",
              'client_ip' => $config->ip,
              'mch_billno' => $mch_billno,
              'mch_id' => $config->account,
              'nonce_str' => $nonce_str,
              're_openid' => $params['open_id'],
              'remark' => "投资越多收益越大哦~",
              'send_name' => $config->name,
              'total_amount' => intval(number_format($params['count'], 2) * 100),
              'total_num' => 1,
              'wishing' => "感谢您参与天天集结号！",
              'wxappid' => $config->appid,
              'sign' => ''
          );
          $send_array['sign'] = $this->create_sign($send_array, $config->account_key);
          // return $send_array;
          // return getcwd();
          $arraytoxml = new ArrayToXML();
          $send_xml = $arraytoxml->toXml($send_array,'');
          // return $send_xml;
          $data = $this->curl_post_ssl($send_xml);
          $data = $this->xmlToArray($data);

          if ($data && $data['return_code'] == 'SUCCESS' && $data['result_code'] == 'SUCCESS') {
            $cash = Cash::findOne(['id' => $params['id']]);
            $cash->state = 2;
            $member->commission = 0;
            if (!$cash->save() && !$member->save()) {
                return array_values($cash->getFirstErrors())[0];
            }
            $query = Cash::find()->orderBy(['state' => SORT_ASC]); // equivalent to $query = EntryForm::find()
            return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
          } else {
            return ['code' => -1, 'msg' => $data['return_msg']];
          }
        }
      }
  }

  /*
  请确保您的libcurl版本是否支持双向认证，版本高于7.20.1
  */
  private function curl_post_ssl($vars, $second=30,$aHeader=array()){
      $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
      $ch = curl_init();
      //超时时间
      curl_setopt($ch,CURLOPT_TIMEOUT,$second);
      curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
      //这里设置代理，如果有的话
      //curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
      //curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
      curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
      //以下两种方式需选择一种

      //第一种方法，cert 与 key 分别属于两个.pem文件
      //默认格式为PEM，可以注释
      curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
      curl_setopt($ch, CURLOPT_SSLCERT,getcwd().'/cert/apiclient_cert.pem');
      //默认格式为PEM，可以注释
      curl_setopt($ch, CURLOPT_SSLKEYTYPE,'PEM');
      curl_setopt($ch, CURLOPT_SSLKEY,getcwd().'/cert/apiclient_key.pem');
      //ca证书
      curl_setopt($ch, CURLOPT_CAINFO, getcwd().'/cert/rootca.pem');
      //第二种方式，两个文件合成一个.pem文件
      //curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');
      if( count($aHeader) >= 1 ){
          curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
      }

      curl_setopt($ch,CURLOPT_POST, 1);
      curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
      $data = curl_exec($ch);
      if($data){
          curl_close($ch);
          return $data;
      }
      else {
          $error = curl_errno($ch);
          echo "call faild, errorCode:$error\n";
          curl_close($ch);
          return false;
      }
  }

  //生成签名
  private function create_sign($string_array, $apiKey)
  {
      $stringA = '';
      foreach ($string_array as $key => $value){
          if(!empty($value) && $key != 'sign'){
              $stringA .= $key.'='.$value;
              if($key != 'wxappid'){
                  $stringA .= '&';
              }
          }
      }
      //转成UTF-8
      $stringA = $this->gbkToUtf8($stringA);
      $stringSignTemp = $stringA.'&key='.$apiKey;
      $sign = MD5($stringSignTemp);
      $sign = strtoupper($sign);
      return $sign;
  }

  //生成随机字符串
  private function create_nonce_str($length){
      $str = null;
      $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
      $max = strlen($strPol)-1;

      for($i=0;$i<$length;$i++){
          $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
      }
      return $str;
  }

  /**
   *自动判断把gbk或gb2312编码的字符串转为utf8
   *能自动判断输入字符串的编码类，如果本身是utf-8就不用转换，否则就转换为utf-8的字符串
   *支持的字符编码类型是：utf-8,gbk,gb2312
   *@$str:string 字符串
   */
  private function gbkToUtf8($str){
      $charset = mb_detect_encoding($str,array('ASCII','UTF-8','GBK','GB2312'));
      $charset = strtolower($charset);
      if("utf-8" != $charset){
          $str = iconv('UTF-8',$charset,$str);
      }
      return $str;
  }

  private function xmlToArray($postStr){
      $msg = array();
      $msg = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
      return $msg;
  }
}
