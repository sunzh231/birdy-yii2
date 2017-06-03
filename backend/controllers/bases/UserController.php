<?php
namespace backend\controllers\bases;

use Yii;
use backend\controllers\RestController;
use yii\data\ActiveDataProvider;
use common\models\User;
use common\models\UserRole;

class UserController extends RestController
{
  public $modelClass = 'common\models\User';

  public function actionIndex()
  {
    $modelClass = $this->modelClass;
    $query = $modelClass::find(); // equivalent to $query = EntryForm::find()
    return new ActiveDataProvider(['query' => $query, 'pagination' => ['pageSize' => 10]]);
  }

  public function actionCreate()
  {
    $params = Yii::$app->request->post();
    $model = new User;
    $model->attributes = $params;
    $model->setPassword($model->password_hash);
    $this->setAdminInfo($model);
    if (!$model->save()) {
      return array_values($model->getFirstErrors())[0];
    }
    foreach ($params['roles'] as $role) {
      $userRole = new UserRole;
      $userRole->role_id = $role['id'];
      $userRole->created_by = 0;
      $userRole->created_at = time();
      $model->link('userRoles', $userRole);
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
      $model->setPassword($model->password_hash);
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
    return User::findOne(['id' => $id]);
  }
}
