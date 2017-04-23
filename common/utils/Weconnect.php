<?php
namespace common\utils;

use app\utils\Curl;

define("TOKEN", "weixin");

class Weconnect
{
  //回复文本消息
  private static function transmitText($object, $content)
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
  private static function transmitNews($object, $arr_item)
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
  private static function transmitMusic($object, $musicArray, $flag = 0)
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
