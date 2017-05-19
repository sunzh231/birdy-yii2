<?php
namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class Loan extends ActiveRecord
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 1;

  public static function tableName()
  {
    return 'bn_loans';
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
    return ['id', 'name', 'tel', 'loan_amount', 'occupation', 'income', 'id_card_front', 'id_card_back', 'bank_pic', 'loan_status',
            'status', 'created_at', 'updated_at'];
  }
  public function safeAttributes()
  {
    return ['id', 'name', 'tel', 'loan_amount', 'occupation', 'income', 'id_card_front', 'id_card_back', 'bank_pic', 'loan_status',
            'status', 'created_at', 'updated_at'];
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

}
