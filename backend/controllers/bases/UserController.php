<?php
namespace backend\controllers\bases;

use Yii;
use backend\controllers\RestController;
use common\models\User;
use common\models\UserRole;

class UserController extends RestController
{
  public $modelClass = 'common\models\User';

  public function actionIndex()
  {
    $pagination = [];
    $query = $this->modelClass::findWithPagination($pagination);
    return $query;
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
      $model->link('userRoles', $userRole);
    }
    return $model;
  }

  public function actionView($id)
  {
    $model = $this->modelClass::findIdentity($id);
    if ($model === null) {
      throw new NotFoundHttpException('Can not find this object!');
    } else {
      return ['user' =>$model, 'roles' => $model->roles];
    }
  }

  public function actionUpdate($id)
  {
    $model = $this->modelClass::findIdentity($id);
    $origin_password = $model->password_hash;
    if ($model === null) {
      throw new NotFoundHttpException('Can not find this object!');
    } else {
      $params = Yii::$app->request->post();
      $model->attributes = $params;
      if ($origin_password != $params['password_hash']) {
        $model->setPassword($model->password_hash);
      }
      if (!$model->save()) {
        return array_values($model->getFirstErrors())[0];
      }
      UserRole::deleteAll('user_id = :user_id', [':user_id' => $model->id]);
      foreach ($params['roles'] as $role) {
        $user_role = new UserRole;
        $user_role->role_id = $role['id'];
        $model->link('userRoles', $user_role);
      }
      return $model;
    }
  }

  public function actionDelete($id)
  {
    $model = $this->modelClass::findIdentity($id);
    // Delete in physical
    if($model) {
      $model->delete();
      $pagination = [];
      $query = $this->modelClass::findWithPagination($pagination);
      return $query;
    }
    // Delete in logical
    // $model->isDeleted = true;
    // $model->save();
    return null;
  }
}
