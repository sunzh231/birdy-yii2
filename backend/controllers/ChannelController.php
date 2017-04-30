<?php
namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Channel;
use common\models\Menu;
use common\utils\Weconnect;

class ChannelController extends RestController
{
  public $modelClass = 'common\models\Channel';

  public function actionMenu()
  {
    $params = Yii::$app->request->post();
    $model = $this->findModel($params['id']);
    $access_token = Weconnect::getAccessToken($model->appid, $model->appsecret);
    // $menu = new Menu;
    $result = Weconnect::createMenu($params['data'], $access_token->access_token);
    return $result;
  }

  public function actionIndex()
  {
    $modelClass = $this->modelClass;
    $query = $modelClass::find(); // equivalent to $query = EntryForm::find()
    return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
  }

  public function actionCreate()
  {
    $model = new Channel;
    $model->attributes = Yii::$app->request->post();
    $model->updated_by = 1;
    $model->created_by = 1;
    if (!$model->save()) {
      return array_values($model->getFirstErrors())[0];
    }
    return $model;
  }

  public function actionView($id)
  {
    $model = $this->findModel($id);
    if ($model === null) {
      throw new NotFoundHttpException('Can not find this object!');
    } else {
      return $model;
    }
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    if ($model === null) {
      throw new NotFoundHttpException('Can not find this object!');
    } else {
      $model->attributes = Yii::$app->request->post();
      if (!$model->save()) {
        return array_values($model->getFirstErrors())[0];
      }
      return $model;
    }
  }

  public function actionDelete($id)
  {
    $model = $this->findModel($id);
    // Delete in physical
    if($model) {
      $model->delete();
      $modelClass = $this->modelClass;
      $query = $modelClass::find(); // equivalent to $query = EntryForm::find()
      return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
    }
    // Delete in logical
    // $model->isDeleted = true;
    // $model->save();
    return null;
  }

  private function findModel($id)
  {
    return Channel::findOne($id);
  }
}
