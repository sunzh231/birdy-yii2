<?php
namespace common\utils;

class ArrayToXML
{
    public function toXml($data){
        $xml = '<xml>';
        foreach ($data as $key => $value){
            $xml .= "<".$key."><![CDATA[".$value."]]></".$key.">";
        }
        $xml .= '</xml>';
        return $xml;
    }
}
