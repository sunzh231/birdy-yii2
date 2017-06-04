<?php

use yii\db\Migration;

class m170504_140806_create_mtl_wechat_resources extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('mtl_wechat_resources', [
      'id' => $this->primaryKey()->comment('主键'),
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
    $this->dropTable('mtl_wechat_resources');
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
