<?php
namespace common\utils;

/**
 * This is util for log pure data.
 * The original log for yii contains too much information.
 * @author Vincent Hou
 **/

class LogUtil
{
    /**
     * Transform LogUtil methods to Yii log methods to use log component configurations
     * @param $name, LogUtil static method names.
     * @param $arguments, function arguments
     * @author Vincent Hou
     **/
    public static function __callStatic($name, $arguments)
    {
        //LogUtil provide warn method
        //But yii log use warning as method name
        if ('warn' === $name) {
            $name = 'warning';
        }
        call_user_func_array("Yii::$name", $arguments);
    }
}
