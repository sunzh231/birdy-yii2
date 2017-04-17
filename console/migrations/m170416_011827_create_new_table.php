<?php

use yii\db\Migration;

/**
 * Handles the creation of table `new`.
 */
class m170416_011827_create_new_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('new', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('new');
    }
}
