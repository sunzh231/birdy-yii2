<?php

use yii\db\Migration;

class m170517_123537_create_bn_loans extends Migration
{
  public function up()
  {
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
      $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('bn_loans', [
      'id' => $this->primaryKey()->comment('主键'),
      'name' => $this->string(32)->notNull()->unique()->comment('姓名'),
      'tel' => $this->string(16)->comment('手机号码'),
      'loan_amount' => $this->decimal(10, 2)->notNull()->comment('贷款金额'),
      'occupation' => $this->string(32)->notNull()->comment('职业'),
      'income' => $this->decimal(10, 2)->notNull()->comment('家庭收入'),
      'id_card_front' => $this->string(128)->notNull()->comment('身份证正面'),
      'id_card_back' => $this->string(128)->comment('身份证背面'),
      'bank_pic' => $this->string(128)->notNull()->comment('银行卡照片'),
      'loan_status' => $this->smallInteger()->notNull()->defaultValue(0)->comment('贷款状态'),

      'status' => $this->smallInteger()->notNull()->defaultValue(1)->comment('删除状态。0：已删除，1：正常'),
      'updated_at' => $this->integer()->notNull()->comment('修改时间'),
      'created_at' => $this->integer()->notNull()->comment('创建时间')
    ], $tableOptions);
  }

  public function down()
  {
    $this->dropTable('bn_loans');
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
