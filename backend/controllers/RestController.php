<?php
namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

class RestController extends ActiveController
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

  public function behaviors()
  {
    return ArrayHelper::merge(parent::behaviors(), [
      'authenticator' => [
        'class' => CompositeAuth::className(),
        'authMethods' => [
          HttpBasicAuth::className(),
          HttpBearerAuth::className(),
          QueryParamAuth::className(),
        ],
      ],
      // 'access' => [
      //   'class' => AccessControl::className(),
      //   'only' => [],
      //   'rules' => [
      //   ],
      // ],
    ]);
  }
}
