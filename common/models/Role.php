<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class Role extends ActiveRecord
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
    return ['id', 'username', 'password_hash', 'email', 'tel', 'access_token',
            'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  }
  public function safeAttributes()
  {
    return ['id', 'username', 'password_hash', 'email', 'tel', 'access_token',
            'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  }

  /**
   * Finds user by username
   *
   * @param string $username
   * @return static|null
   */
  public static function findByUsername($username)
  {
    return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
  }

  /**
   * @inheritdoc
   */
  public function getId()
  {
    return $this->getPrimaryKey();
  }
}
