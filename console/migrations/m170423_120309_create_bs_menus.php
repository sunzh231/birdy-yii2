<?php

use yii\db\Migration;

class m170423_120309_create_bs_menus extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bs_menus', [
      'id' => $this->primaryKey()->comment('主键'),
      'name' => $this->string(8)->notNull()->comment('菜单名称'),
      'type' => $this->integer()->notNull()->defaultValue(0)->comment('菜单类型'),
      'grade_code' => $this->string(128)->notNull()->comment('菜单级别编码'),
      'event_key' => $this->string(16)->comment('event key'),
      'content' => $this->string(128)->unique()->comment('菜单配置内容'),
      'sort_no' => $this->smallInteger()->notNull()->comment('排序号'),
      'channel_id' => $this->integer()->notNull()->comment('外键。渠道ID'),

      'updated_by' => $this->integer()->notNull()->comment('修改人'),
      'updated_at' => $this->integer()->notNull()->comment('修改时间'),
      'created_at' => $this->integer()->notNull()->comment('创建人'),
      'created_by' => $this->integer()->notNull()->comment('创建时间')
    ]);
  }

  public function down()
  {
    $this->dropTable('bs_menus');
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
