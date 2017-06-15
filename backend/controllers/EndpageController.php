<?php
namespace backend\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use backend\models\EndPage;
use backend\models\Issue;
use backend\models\Pic;

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
    $issues = Issue::find()->all();
    $pics = Pic::find()->all();
    if ($model === null) {
      throw new NotFoundHttpException('Can not find this object!');
    } else {
      return ['content' => $model, 'issues' => $issues, 'pics' => $pics ];
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
        $issue->question = $arr['question'];
        $issue->answer = $arr['answer'];
        $issue->description = '';
        $issue->save();
      }
      Pic::deleteAll();
      foreach ($params['banners'] as $arr) {
        $pic = new Pic;
        $pic->name = $arr[0];
        $pic->url = $arr[1];
        $pic->save();
      }
      $pic = new Pic;
      $pic->name = 'qr';
      $pic->url = $params['qr'][0];
      $pic->save();
      if ($model === null) {
        throw new NotFoundHttpException('Can not find this object!');
      } else {
        $model->attributes = Yii::$app->request->post();
        $model->type = 1;
        if (!$model->save()) {
          return array_values($model->getFirstErrors())[0];
        }
        return $model;
      }
    } else {
      $model = new EndPage;
      $model->attributes = Yii::$app->request->post();
      $model->type = 1;
      if (!$model->save()) {
        return array_values($model->getFirstErrors())[0];
      }
      Issue::deleteAll();
      $params = Yii::$app->request->post();
      foreach ($params['issues'] as $arr) {
        $issue = new Issue;
        $issue->question = $arr['question'];
        $issue->answer = $arr['answer'];
        $issue->description = '';
        $issue->save();
      }
      Pic::deleteAll();
      foreach ($params['banners'] as $arr) {
        $pic = new Pic;
        $pic->name = $arr[0];
        $pic->url = $arr[1];
        $pic->save();
      }
      $pic = new Pic;
      $pic->name = 'qr';
      $pic->url = $params['qr'][0];
      $pic->save();
      return $model;
    }
  }

  private function findModel($id)
  {
    return EndPage::findOne(['id' => $id]);
  }
}
