<?php
namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Pic extends ActiveRecord
{
  public static function tableName()
  {
    return 'bn_pics';
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
    return ['id', 'name', 'url', 'desc'];
  }
  public function safeAttributes()
  {
    return ['name', 'url', 'desc'];
  }

}
