<?php
namespace backend\controllers\soc;

use Yii;
use backend\controllers\RestController;
use yii\data\ActiveDataProvider;
use backend\models\soc\Fans;

class FansController extends RestController
{
  public $modelClass = 'backend\models\soc\Fans';

  public function actionIndex()
  {
    $modelClass = $this->modelClass;
    $query = $modelClass::find(); // equivalent to $query = EntryForm::find()
    return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
  }

  public function actionCreate()
  {
    $model = new Fans;
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
    return Fans::findOne(['id' => $id]);
  }
}
