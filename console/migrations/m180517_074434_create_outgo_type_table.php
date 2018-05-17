<?php

use yii\db\Migration;

/**
 * Handles the creation of table `outgo_type`.
 */
class m180517_074434_create_outgo_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('outgo_type', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('outgo_type');
    }
}
