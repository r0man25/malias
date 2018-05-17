<?php

use yii\db\Migration;

/**
 * Handles the creation of table `income_row`.
 */
class m180517_071944_create_income_row_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('income_row', [
            'id' => $this->primaryKey(),
            'income_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantitu' => $this->integer()->notNull(),
            'price' => $this->decimal(8,2)->notNull(),
        ]);

        // creates index for column `income_id`
        $this->createIndex(
            'idx-income_row-income_id',
            'income_row',
            'income_id'
        );
        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-income_row-income_id',
            'income_row',
            'income_id',
            'income',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('income_row');
    }
}
