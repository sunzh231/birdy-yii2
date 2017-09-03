<?php
namespace backend\controllers\bases;

use Yii;
use backend\controllers\RestController;
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
    $this->setAdminInfo($model);
    if (!$model->save()) {
      return array_values($model->getFirstErrors())[0];
    }
    return $model;
  }

  public function actionView($id)
  {
    $model = $this->modelClass::findById($id);
    if ($model === null) {
      throw new NotFoundHttpException('Can not find this object!');
    } else {
      return $model;
    }
  }

  public function actionUpdate($id)
  {
    $model = $this->modelClass::findById($id);
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
    $model = $this->modelClass::findById($id);
    // Delete in physical
    if($model) {
      $model->delete();
      $pagination = [];
      $query = $this->modelClass::findWithPagination($pagination);
      return $query;
    }
    // Delete in logical
    // $model->status = 0;
    // $model->save();
    return null;
  }
}