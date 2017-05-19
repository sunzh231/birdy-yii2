<?php
namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\Content;

class ContentController extends RestController
{
  public $modelClass = 'backend\models\Content';

  public function actionIndex()
  {
    $modelClass = $this->modelClass;
    $query = $modelClass::find(); // equivalent to $query = EntryForm::find()
    return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
  }

  public function actionCreate()
  {
    $model = new Content;
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

  private function findModel($id)
  {
    return Content::findOne(['id' => $id]);
  }
}
