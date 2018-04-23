<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attr`.
 */
class m180423_055634_create_attr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attr', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull(),
            'type'=>$this->string(),
            'unit'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('attr');
    }
}
