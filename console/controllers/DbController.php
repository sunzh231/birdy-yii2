<?php
namespace console\controllers;

use yii\console\Controller;
use common\models\User;

class DbController extends Controller {
  /**
   * Run SomeModel::some_method for a period of time
   * @param object $data
   * @return string msg
   */
  public function actionInit($data = null){
    // INSERT INTO bs_users (username,password_hash,email,tel,access_token,created_by,created_at,updated_by,updated_at) VALUES("test1","123456","sunzh231@qq.com","18353699232", "123456",1,1,1,1);
    $data = [
      "username" => "admin",
      "realname" => "admin",
      "password_hash" => "123456",
      "email" => "admin@example.com",
      "tel" => "18353699232",
      "created_by" => 1,
      "updated_by" => 1
    ];
    $model = new User;
    $model->attributes = $data;
    $model->setPassword($model->password_hash);
    if ($model->save()) {
      echo "create user successfully!";
    } else {
      echo "create user faild!";
    }
  }
}
