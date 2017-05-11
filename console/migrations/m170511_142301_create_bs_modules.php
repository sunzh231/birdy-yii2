<?php

use yii\db\Migration;

class m170511_142301_create_bs_modules extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bs_modules', [
      'id' => $this->primaryKey()->comment('主键'),
      'name' => $this->string(32)->notNull()->comment('模块名'),
      'auth_name' => $this->string(32)->notNull()->unique()->comment('模块名'),
      'desc' => $this->string(128)->comment('描述'),
      'parent_id' => $this->integer()->notNull()->defaultValue(0)->comment('父级ID'),
      'grade_code' => $this->string(128)->comment('级别编码'),

      'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('删除状态。0：已删除，1：正常'),
      'updated_by' => $this->integer()->notNull()->comment('修改人'),
      'updated_at' => $this->integer()->notNull()->comment('修改时间'),
      'created_by' => $this->integer()->notNull()->comment('创建人'),
      'created_at' => $this->integer()->notNull()->comment('创建时间')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('bs_modules');
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
