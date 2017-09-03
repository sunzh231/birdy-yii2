<?php

use yii\db\Migration;

class m170603_120931_create_pcm_categories extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('pcm_categories', [
      'id' => $this->primaryKey()->comment('主键'),
      'name' => $this->string(16)->notNull()->unique()->comment('分类名称'),
      'code' => $this->string(16)->notNull()->unique()->comment('编码'),
      'grade_code' => $this->string(64)->notNull()->unique()->comment('等级编码'),
      'parent_id' => $this->string(128)->comment('logo'),
      'sort_no' => $this->integer()->notNull()->defaultValue(0)->comment('顺序号'),
      'desc' => $this->string(16)->comment('描述'),
      'tenant_id' => $this->integer()->comment('租户ID'),

      'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('删除状态。0：已删除，1：正常'),
      'updated_by' => $this->integer()->notNull()->comment('修改人'),
      'updated_at' => $this->integer()->notNull()->comment('修改时间'),
      'created_by' => $this->integer()->notNull()->comment('创建人'),
      'created_at' => $this->integer()->notNull()->comment('创建时间')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('pcm_categories');
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