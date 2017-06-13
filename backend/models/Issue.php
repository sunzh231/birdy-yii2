<?php
namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Issue extends ActiveRecord
{
  public static function tableName()
  {
    return 'bn_issues';
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
    return ['id', 'question', 'answer', 'description'];
  }
  public function safeAttributes()
  {
    return ['question', 'answer', 'description'];
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
