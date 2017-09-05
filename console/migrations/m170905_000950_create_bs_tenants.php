<?php

use yii\db\Migration;

class m170905_000950_create_bs_tenants extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bs_tenants', [
      'id' => $this->primaryKey()->comment('主键'),
      'name' => $this->string(32)->notNull()->unique()->comment('用户名'),
      'email' => $this->string(32)->unique()->comment('电子邮箱'),
      'tel' => $this->string(16)->unique()->comment('手机号码'),

      'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('删除状态。0：已删除，1：正常'),
      'updated_by' => $this->integer()->notNull()->comment('修改人'),
      'updated_at' => $this->integer()->notNull()->comment('修改时间'),
      'created_by' => $this->integer()->notNull()->comment('创建人'),
      'created_at' => $this->integer()->notNull()->comment('创建时间')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('bs_tenants');
  }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170905_000950_create_bs_tenants cannot be reverted.\n";

        return false;
    }
    */
}
