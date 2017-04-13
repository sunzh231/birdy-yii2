<?php
namespace common\utils;

use app\utils\ArrayToXML;

class WechatPacket {
    private $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';//请求URL
    private $mch_id;//商户号
    private $weixin_appid;//公众账号appid
    private $send_name;//商户名称
    private $total_num = 1;//发送红包总人数
    private $wishing;//红包祝福语
    private $client_ip;//调用接口的机器Ip地址
    private $act_name;//活动名称
    private $remark;//备注信息
    private $nonce_str;//随机字符串，不长于32位
    private $api_password;
    private $arraytoxml;//数组转xml
    /**
     * 公钥
     */
    private $public_key = "./cert/apiclient_cert.pem";
    /**
     * 私钥
     */
    private $private_key = './cert/apiclient_key.pem';
    /**
     * ca证书
     */
    private $rootca = './cert/rootca.pem';

    public function __construct()
    {
        //初始化红包设置信息
        $this->weixin_appid = C('wap_weixin_appid');
        $this->mch_id = C('wechat_mch_id');
        $this->send_name = C('wechat_send_name');
        $this->wishing = C('wechat_wishing');
        $this->act_name = C('wechat_act_name');
        $this->client_ip = $_SERVER['SERVER_ADDR'];
        $this->remark = C('wechat_remark');
        $this->nonce_str = $this->create_nonce_str(32);
        $this->api_password = C('wechat_api_password');
        $this->arraytoxml = new ArrayToXML();
    }

    public function send_post($mch_billno, $re_openid, $total_amount){
        $sign = $this->create_sign($mch_billno,$re_openid,$total_amount);

        $send_array = array(
            'nonce_str' => $this->nonce_str,
            'mch_billno' => $mch_billno,
            'mch_id' => $this->mch_id,
            'wxappid' => $this->weixin_appid,
            'send_name' => "天天集结号",
            're_openid' => $re_openid,
            'total_amount' => $total_amount,
            'total_num' => 1,
            'wishing' => "感谢您参与天天集结号！",
            'client_ip' => $this->client_ip,
            'act_name' => "天天集结号现金提取",
            'remark' => "投资越多收益越大哦~",
            'sign' => $sign,
        );
        $send_xml = $this->arraytoxml->toXml($send_array,'');
        $data = $this->curl_post_ssl($this->url, $send_xml);
        $data = $this->xmlToArray($data);
        file_put_contents('adki',var_export($data,true),FILE_APPEND);
    }

    /*
    请确保您的libcurl版本是否支持双向认证，版本高于7.20.1
    */
    private function curl_post_ssl($url, $vars, $second=30,$aHeader=array()){
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
        curl_setopt($ch,CURLOPT_SSLCERTTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLCERT,getcwd().$this->public_key);
        //默认格式为PEM，可以注释
        curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
        curl_setopt($ch,CURLOPT_SSLKEY,getcwd().$this->private_key);
        //ca证书
        curl_setopt($ch,CURLOPT_CAINFO,$this->rootca);
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
    private function create_sign($mch_billno,$re_openid,$total_amount){
        $string_array = array(
            'act_name' => $this->act_name,
            'client_ip' => $this->client_ip,
            'mch_billno' => $mch_billno,
            'mch_id' => $this->mch_id,
            'nonce_str' => $this->nonce_str,
            're_openid' => $re_openid,
            'remark' => $this->remark,
            'send_name' => $this->send_name,
            'total_amount' => $total_amount,
            'total_num' => $this->total_num,
            'wishing' => $this->wishing,
            'wxappid' => $this->weixin_appid,
        );
        foreach ($string_array as $key => $value){
            if(!empty($value)){
                $stringA .= "$key=$value";
                if($key != 'wxappid'){
                    $stringA .= '&';
                }
            }
        }
        //转成UTF-8
        $stringA = $this->gbkToUtf8($stringA);
        $stringSignTemp="$stringA&key=$this->api_password";
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
