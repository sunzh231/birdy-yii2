<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

class Banner extends ActiveRecord
{
  public static function tableName()
  {
    return 'bn_banners';
  }

  public function behaviors()
  {
    return [
    ];
  }

  public function rules()
  {
    return [
    ];
  }

  public function attributes()
  {
    return ['id', 'name', 'url', 'content_id'];
  }
  public function safeAttributes()
  {
    return ['id', 'name', 'url', 'content_id'];
  }

  /**
   * Finds user by username
   *
   * @param string $username
   * @return static|null
   */
  public static function findByName($name)
  {
    return static::findOne(['name' => $name]);
  }

}
