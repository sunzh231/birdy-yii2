<?php

use yii\db\Migration;

class m170613_133031_create_bn_pics extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bn_pics', [
      'id' => $this->primaryKey()->comment('主键'),
      'name' => $this->string(32)->notNull()->unique()->comment('页面名称'),
      'url' => $this->string(128)->comment('地址'),
      'desc' => $this->string(128)->comment('描述')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('bn_pics');
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
