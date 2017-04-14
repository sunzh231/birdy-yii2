<?php
namespace backend\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\utils\Curl;

class BaseController extends ActiveController
{
  public $serializer = [
    'class' => 'yii\rest\Serializer',
    'collectionEnvelope' => 'items',
  ];

  public function actions()
  {
    $actions = parent::actions();
    // 注销系统自带的实现方法
    unset($actions['index'], $actions['update'], $actions['create'], $actions['delete'], $actions['view']);
    return $actions;
  }
}
