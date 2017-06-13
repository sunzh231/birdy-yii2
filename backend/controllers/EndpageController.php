<?php
namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\EndPage;
use backend\models\Issue;

class EndpageController extends RestController
{
  public $modelClass = 'backend\models\EndPage';

  public function actionIndex()
  {
    $modelClass = $this->modelClass;
    $query = $modelClass::find(); // equivalent to $query = EntryForm::find()
    return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
  }

  public function actionCreate()
  {
    $model = new EndPage;
    $model->attributes = Yii::$app->request->post();
    if (!$model->save()) {
      return array_values($model->getFirstErrors())[0];
    }
    return $model;
  }

  public function actionView($id)
  {
    $model = $this->findModel($id);
    $banners = $model->banners;
    if ($model === null) {
      throw new NotFoundHttpException('Can not find this object!');
    } else {
      return ['content' => $model, 'banners' => $banners ];
    }
  }

  public function actionUpdate($id)
  {
    $model = $this->findModel($id);
    if ($model) {
      Issue::deleteAll();
      $params = Yii::$app->request->post();
      foreach ($params['issues'] as $arr) {
        $issue = new Issue;
        $issue->question = $arr[0];
        $issue->answer = $arr[1];
        $issue->description = '';
        $issue->save();
      }
      if ($model === null) {
        throw new NotFoundHttpException('Can not find this object!');
      } else {
        $model->attributes = Yii::$app->request->post();
        $model->name = 'birdy';
        if (!$model->save()) {
          return array_values($model->getFirstErrors())[0];
        }
        return $model;
      }
    } else {
      $model = new EndPage;
      $model->attributes = Yii::$app->request->post();
      if (!$model->save()) {
        return array_values($model->getFirstErrors())[0];
      }
      Issue::deleteAll();
      $params = Yii::$app->request->post();
      foreach ($params['issues'] as $arr) {
        $issue = new Issue;
        $issue->question = $arr[0];
        $issue->answer = $arr[1];
        $issue->description = '';
        $issue->save();
      }
      return $model;
    }
  }

  private function findModel($id)
  {
    return Content::findOne(['id' => $id]);
  }
}
