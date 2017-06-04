<?php
namespace backend\models\socails;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Menu extends ActiveRecord
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 1;

  public static function tableName()
  {
    return 'bs_menus';
  }

  /**
   * @inheritdoc
   */
  public function behaviors()
  {
    return [
      TimestampBehavior::className(),
    ];
  }

  /**
   * @inheritdoc
   */
  public function rules()
  {
    return [
    ];
  }

  public function attributes()
  {
    return ['id', 'name', 'type', 'grade_code', 'event_key', 'content',
            'created_by', 'created_at', 'updated_by', 'updated_at'];
  }
  public function safeAttributes()
  {
    return ['name', 'type', 'grade_code', 'event_key', 'content'];
  }
}
