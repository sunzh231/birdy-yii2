<?php

use yii\db\Migration;

class m170613_034945_create_bn_end_pages extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bn_end_pages', [
      'id' => $this->primaryKey()->comment('主键'),
      'title' => $this->string(32)->notNull()->unique()->comment('标题'),
      'type' => $this->integer()->notNull()->unique()->comment('类型'),
      'pic' => $this->string(128)->comment('图片'),
      'description' => $this->string(128)->comment('描述')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('bn_end_pages');
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
