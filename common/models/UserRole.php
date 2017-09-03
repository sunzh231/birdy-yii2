<?php
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

class UserRole extends ActiveRecord
{

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'bs_user_role';
  }

  public function attributes()
  {
    return ['id', 'user_id', 'role_id'];
  }

  public function safeAttributes()
  {
    return ['user_id', 'role_id'];
  }

  public static function findByParams($params)
  {
    return static::findOne(['user_id' => $params['user_id'], 'role_id' => $params['role_id']]);
  }

}
