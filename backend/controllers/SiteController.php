<?php
namespace backend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\rest\ActiveController;
use common\models\User;
use Lcobucci\JWT\Signer\Hmac\Sha256;

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
      $model = User::findByParams($params['name']);
      $signer = new Sha256();
      $token = Yii::$app->jwt->getBuilder()->setIssuer('http://example.com'); // Retrieves the generated token

      // return $token;
      if ($model->validatePassword($params['password'])) {
        return ['code' => 0, 'msg' => 'OK', 'data' => $model, 'token' => $token];
      } else {
        return ['code' => -1, 'msg' => '用户名或密码错误'];
      }
    } catch (InvalidParamException $e) {
      throw new BadRequestHttpException($e->getMessage());
    }
  }

  public function actionLogout()
  {

  }
}
