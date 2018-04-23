<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attr_val`.
 */
class m180423_055733_create_attr_val_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attr_val', [
            'id' => $this->primaryKey(),
            'attr_id' => $this->integer()->notNull(),
            'val' => $this->string()->notNull(),
        ]);


        // creates index for column `attr_id`
        $this->createIndex(
            'idx-attr_val-attr_id',
            'attr_val',
            'attr_id'
        );
        // add foreign key for table `attr`
        $this->addForeignKey(
            'fk-attr_val-attr_id',
            'attr_val',
            'attr_id',
            'attr',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('attr_val');
    }
}
