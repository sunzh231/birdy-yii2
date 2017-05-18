<?php
namespace backend\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\Role;

class Content extends ActiveRecord implements IdentityInterface
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 1;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'bn_contents';
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
  public static function findByName($username)
  {
    return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
  }

}
