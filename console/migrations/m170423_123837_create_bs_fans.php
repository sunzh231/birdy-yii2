<?php

use yii\db\Migration;

class m170423_123837_create_bs_fans extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bs_fans', [
      'id' => $this->primaryKey()->comment('主键'),
      'nickname' => $this->string(8)->comment('昵称'),
      'openid' => $this->integer()->notNull()->defaultValue(0)->comment('openid'),
      'headimgurl' => $this->string(128)->comment('头像'),
      'unionid' => $this->string(128)->notNull()->comment('unionid'),
      'sex' => $this->smallInteger()->defaultValue(0)->comment('性别'),
      'language' => $this->string(16)->comment('语言'),
      'city' => $this->string(128)->comment('城市'),
      'province' => $this->string(32)->comment('省'),
      'country' => $this->integer()->comment('国家'),
      'subscribe' => $this->smallInteger()->notNull()->defaultValue(0)->comment('是否关注。0：未关注，1：关注'),
      'subscribe_time' => $this->integer()->notNull()->comment('关注事件'),
      'remark' => $this->string(128)->comment('备注'),
      'tagid_list' => $this->string(128)->comment('标签'),
      'channel_id' => $this->integer()->notNull()->comment('外键。渠道ID'),

      'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('删除状态。0：已删除，1：正常'),
      'updated_by' => $this->integer()->notNull()->comment('修改人'),
      'updated_at' => $this->integer()->notNull()->comment('修改时间'),
      'created_at' => $this->integer()->notNull()->comment('创建人'),
      'created_by' => $this->integer()->notNull()->comment('创建时间')
    ]);
  }

  public function down()
  {
    $this->dropTable('bs_fans');
  }

  /*
  // Use safeUp/safeDown to run migration code within a transaction
  public function safeUp()
  {
  }

  public function safeDown()
  {
  }
  */
}
