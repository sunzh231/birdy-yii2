<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use common\utils\Curl;
use common\utils\Robot;

class RobotController extends ActiveController
{
  public $modelClass = 'common\models\Channel';

  public function actionInit()
  {
    $appid = 'wx782c26e4c19acffb';
    $result = Robot::getUUID($appid);
    return $result;
  }
}
