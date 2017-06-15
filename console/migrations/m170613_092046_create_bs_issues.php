<?php

use yii\db\Migration;

class m170613_092046_create_bs_issues extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bn_issues', [
      'id' => $this->primaryKey()->comment('主键'),
      'question' => $this->string(128)->notNull()->unique()->comment('问题'),
      'answer' => $this->string(128)->notNull()->unique()->comment('回答'),
      'description' => $this->string(128)->comment('描述')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('bn_issues');
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
