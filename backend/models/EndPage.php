<?php
namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class EndPage extends ActiveRecord
{
  public static function tableName()
  {
    return 'bn_end_pages';
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
    return ['id', 'title', 'type', 'pic', 'description'];
  }
  public function safeAttributes()
  {
    return ['title', 'type', 'pic', 'description'];
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

  public function getBanners()
  {
    return $this->hasMany(Banner::className(), ['content_id' => 'id']);
  }

}
