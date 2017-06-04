<?php
namespace backend\models\pcm;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\data\ActiveDataProvider;

class Product extends ActiveRecord
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 1;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'bs_roles';
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
    return ['id', 'name', 'desc', 'tenant_id',
            'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  }
  public function safeAttributes()
  {
    return ['id', 'name', 'desc', 'tenant_id',
            'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  }

  public function getUsers()
  {
    return $this->hasMany(User::className(), ['id' => 'user_id'])
      ->viaTable('bs_user_role', ['role_id' => 'id']);
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
