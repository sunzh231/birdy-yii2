<?php

use yii\db\Migration;

class m130524_201442_create_bs_users extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bs_users', [
      'id' => $this->primaryKey()->comment('主键'),
      'username' => $this->string(32)->notNull()->unique()->comment('用户名'),
      'realname' => $this->string(32)->notNull()->unique()->comment('真实姓名'),
      'auth_key' => $this->string(32)->comment('session登录验证字段'),
      'password_hash' => $this->string(128)->notNull()->comment('加密密码'),
      'password_reset_token' => $this->string(128)->unique()->comment('密码重置token'),
      'email' => $this->string(32)->unique()->comment('电子邮箱'),
      'tel' => $this->string(16)->unique()->comment('手机号码'),
      'access_token' => $this->string(128)->unique()->comment('restful登录验证字段'),
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
    $this->dropTable('bs_users');
  }
}
