<?php

use yii\db\Migration;

class m170511_123840_create_bs_user_role extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bs_user_role', [
      'id' => $this->primaryKey()->comment('主键'),
      'user_id' => $this->integer()->notNull()->comment('用户ID'),
      'role_id' => $this->integer()->notNull()->comment('角色ID'),

      'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('删除状态。0：已删除，1：正常'),
      'created_by' => $this->integer()->notNull()->comment('创建人'),
      'created_at' => $this->integer()->notNull()->comment('创建时间')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('bs_user_role');
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
