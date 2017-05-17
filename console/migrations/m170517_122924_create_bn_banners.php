<?php

use yii\db\Migration;

class m170517_122924_create_bn_banners extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bn_banners', [
      'id' => $this->primaryKey()->comment('主键'),
      'name' => $this->string(32)->notNull()->unique()->comment('页面名称'),
      'url' => $this->string(128)->comment('描述'),
      'content_id' => $this->integer()->notNull()->comment('确认跳转链接')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('bn_banners');
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
