<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Module extends ActiveRecord
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 1;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'bs_modules';
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
      ['status', 'default', 'value' => self::STATUS_ACTIVE],
      ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
    ];
  }

  public function attributes()
  {
    return ['id', 'name', 'desc', 'parent_id', 'grade_code', 'sync_status',
            'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  }
  public function safeAttributes()
  {
    return ['name', 'desc', 'parent_id', 'grade_code', 'sync_status'];
  }

}
