<?php
namespace backend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends ActiveController
{
  public $modelClass = 'common\models\User';

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

  public function actionSignup()
  {
    $model = new User;
    $model->attributes = Yii::$app->request->post();
    $model->setPassword($model->password_hash);
    if (!$model->save()) {
      return array_values($model->getFirstErrors())[0];
    }
    return $model;
  }

  public function actionSignin()
  {
    try {
      $params = Yii::$app->request->post();
      $model = User::findByLoginParams($params['name']);
      if ($model->validatePassword($params['password'])) {
        $model->generateAccessToken();
        if (!$model->save()) {
          return array_values($model->getFirstErrors())[0];
        }
        return ['success' => true, 'msg' => 'OK', 'token' => $model->access_token];
      } else {
        return ['success' => false, 'msg' => '用户名或密码错误'];
      }
    } catch (InvalidParamException $e) {
      throw new BadRequestHttpException($e->getMessage());
    }
  }

  public function actionLogout()
  {

  }
}
