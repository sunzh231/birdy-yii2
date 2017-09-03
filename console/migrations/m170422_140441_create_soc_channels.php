<?php

use yii\db\Migration;

class m170422_140441_create_soc_channels extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('soc_channels', [
      'id' => $this->primaryKey()->comment('主键'),
      'name' => $this->string(32)->notNull()->unique()->comment('账号名称'),
      'account_type' => $this->integer()->notNull()->defaultValue(0)->comment('账号类型'),
      'channel_type' => $this->integer()->notNull()->defaultValue(0)->comment('渠道类型'),
      'originid' => $this->string(32)->unique()->comment('原始ID'),
      'appid' => $this->string(32)->notNull()->unique()->comment('app id'),
      'appsecret' => $this->string(32)->notNull()->unique()->comment('app secret'),
      'wechat_token' => $this->string(128)->comment('微信access_token'),
      'tenant_id' => $this->integer()->comment('租户ID'),

      'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('删除状态。0：已删除，1：正常'),
      'updated_by' => $this->integer()->notNull()->comment('修改人'),
      'updated_at' => $this->integer()->notNull()->comment('修改时间'),
      'created_at' => $this->integer()->notNull()->comment('创建人'),
      'created_by' => $this->integer()->notNull()->comment('创建时间')
    ]);
  }

  public function down()
  {
    $this->dropTable('soc_channels');
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
