<?php
namespace common\utils;

use common\utils\Curl;

define("TOKEN", "weixin");

class Weconnect
{
  public static function getAccessToken($appid, $appsecret)
  {
    $params = ['appid' => $appid, 'secret' => $appsecret];
    $getUrl = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential';
    $curl = new Curl;
    return $curl->Get($getUrl, $params);
  }

  public static function createMenu($params, $token)
  {
    $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token;
    $curl = new Curl;
    return $curl->Post($url, $params);
  }

  public static function checkSignature($signature, $timestamp, $nonce)
  {
    $token = TOKEN;
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
  //回复文本消息
  public static function transmitText($object, $content)
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
  public static function transmitNews($object, $arr_item)
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
  public static function transmitMusic($object, $musicArray, $flag = 0)
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
