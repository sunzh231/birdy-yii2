<?php

use yii\db\Migration;

class m170517_122403_create_bn_contents extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bn_contents', [
      'id' => $this->primaryKey()->comment('主键'),
      'name' => $this->string(32)->notNull()->unique()->comment('页面名称'),
      'description' => $this->string(128)->comment('描述'),
      'link' => $this->string(128)->notNull()->comment('确认跳转链接')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('bn_contents');
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
