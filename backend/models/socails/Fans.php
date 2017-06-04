<?php
namespace backend\models\socails;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Fans extends ActiveRecord
{
  const STATUS_DELETED = 0;
  const STATUS_ACTIVE = 1;

  public static function tableName()
  {
    return 'bs_fans';
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
    return ['id', 'nickname', 'headimgurl', 'openid', 'unionid', 'sex', 'language',
            'city', 'province', 'country', 'subscribe', 'subscribe_time', 'remark', 'tagid_list'
            'status', 'created_by', 'created_at', 'updated_by', 'updated_at'];
  }
  public function safeAttributes()
  {
    return ['nickname', 'headimgurl', 'openid', 'unionid', 'sex', 'language',
            'city', 'province', 'country', 'subscribe', 'subscribe_time', 'remark', 'tagid_list'];
  }

  public function getId()
  {
    return $this->getPrimaryKey();
  }
}
