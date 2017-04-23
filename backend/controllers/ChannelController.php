<?php
namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use common\models\Channel;

class ChannelController extends RestController
{
  public $modelClass = 'common\models\Channel';

  public function actionIndex()
  {
    return ['test' => $this->modelClass];
    $modelClass = $this->modelClass;
    $query = $modelClass::find(); // equivalent to $query = EntryForm::find()
    return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
  }

  public function actionCreate()
  {
    $model = new Channel;
    $model->attributes = Yii::$app->request->post();
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
    return Channel::findOne(['id' => $id]);
  }
}
