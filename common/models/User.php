<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\models\Role;
use yii\data\ActiveDataProvider;

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
class User extends ActiveRecord implements IdentityInterface
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 1;

  /**
   * @inheritdoc
   */
  public static function tableName()
  {
    return 'bs_users';
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
    return ['id', 'username', 'realname', 'password_hash', 'email', 'tel', 'access_token', 'expired_time',
            'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  }

  public function safeAttributes()
  {
    return ['username', 'realname', 'password_hash', 'email', 'tel', 'access_token', 'expired_time', 'created_by', 'updated_by'];
  }

  /**
   * @inheritdoc
   */
  public static function findIdentity($id)
  {
    return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
  }

  public static function findByLoginParams($params)
  {
    return static::find()->where([
        'and', 'status=:status',
        ['or', 'username=:username', 'email=:email', 'tel=:tel']
      ], [
        ':status' => self::STATUS_ACTIVE,
        ':username' => $params,
        ':email' => $params,
        ':tel' => $params
      ])->one();
  }

  public static function findByParams($params)
  {
    return static::find()->where([
        'and', 'status=:status',
        ['or', ['like', 'username', $params], ['like', 'email', $params], ['like', 'tel', $params]]
      ], [
        ':status' => self::STATUS_ACTIVE
      ]);
  }

  public static function findWithPagination($params=null, $pagination = null)
  {
    return new ActiveDataProvider([
      'query' => static::findByParams($params),
      'pagination' => array_merge(['pageSize' => 10], $pagination),
      'sort' => [
        'defaultOrder' => [
          'updated_at' => SORT_DESC
        ]
      ]
    ]);
  }

  public static function findIdentityByAccessToken($token, $type = null)
  {
    $model = static::findOne(['access_token' => $token]);
    if ($model && $model->expired_time > strtotime(date('Y-m-d H:i:s'))) {
      return $model;
    } else {
      return null;
    }
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

  /**
   * @inheritdoc
   */
  public function getAuthKey()
  {
    return $this->auth_key;
  }

  public function getUserRoles()
  {
    return $this->hasMany(UserRole::className(), ['user_id' => 'id']);
  }

  public function getRoles()
  {
    return $this->hasMany(Role::className(), ['id' => 'role_id'])
      ->via('userRoles');
  }

  /**
   * @inheritdoc
   */
  public function validateAuthKey($authKey)
  {
    return $this->getAuthKey() === $authKey;
  }

  /**
   * Validates password
   *
   * @param string $password password to validate
   * @return bool if password provided is valid for current user
   */
  public function validatePassword($password)
  {
    return Yii::$app->security->validatePassword($password, $this->password_hash);
  }

  /**
   * Generates password hash from password and sets it to the model
   *
   * @param string $password
   */
  public function setPassword($password)
  {
    $this->password_hash = Yii::$app->security->generatePasswordHash($password);
  }

  # 生成access_token
  public function generateAccessToken()
  {
    $this->access_token = Yii::$app->security->generateRandomString();
    $this->expired_time = strtotime(date('Y-m-d 01:59:59')) + 24 * 60 * 60;
  }

}
