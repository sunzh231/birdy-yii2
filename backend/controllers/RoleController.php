<?php
namespace backend\controllers;

use Yii;
use common\models\Role;

class RoleController extends RestController
{
  public $modelClass = 'common\models\Role';

  public function actionIndex()
  {
    $pagination = [];
    $query = $this->modelClass::findWithPagination($pagination); // equivalent to $query = EntryForm::find()
    return $query;
  }

  public function actionCreate()
  {
    $model = new Role;
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
    $model = Role::findById($id);
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
    $model = Role::findById($id);
    // Delete in physical
    if($model) {
      $model->delete();
      $query = $this->modelClass::find(); // equivalent to $query = EntryForm::find()
      return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
    }
    // Delete in logical
    // $model->status = 0;
    // $model->save();
    return null;
  }
}
