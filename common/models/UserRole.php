<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class UserRole extends ActiveRecord
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 1;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'bs_user_role';
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
    return ['id', 'user_id', 'role_id',
            'status', 'created_by', 'created_at'];
  }
  public function safeAttributes()
  {
    return ['id', 'user_id', 'role_id',
            'status', 'created_by', 'created_at'];
  }

  public static function findById($id)
  {
    return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
  }

  public static function findWithPagination($pagination = null)
  {
    return new ActiveDataProvider(['query' => static::find(), 'pagination' => ['pageSize' => 10]]);
  }

}
