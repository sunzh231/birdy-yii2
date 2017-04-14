<?php
namespace backend\models;

use yii\db\ActiveRecord;

class Rest extends ActiveRecord
{
  public static function tableName()
  {
    return 'rest';
  }

  public function rules()
  {
    return [
    ];
  }
  public function attributes()
  {
    return ['id', 'name', 'create_at', 'update_at', 'create_by', 'update_by'];
  }
  public function safeAttributes()
  {
    return ['id', 'name', 'create_at', 'update_at', 'create_by', 'update_by'];
  }

  public function insert($runValidation = true, $attributeNames = null)
  {
    return parent::insert($runValidation, $attributeNames);
  }
}
