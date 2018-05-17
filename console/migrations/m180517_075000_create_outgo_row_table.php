<?php

use yii\db\Migration;

/**
 * Handles the creation of table `outgo_row`.
 */
class m180517_075000_create_outgo_row_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('outgo_row', [
            'id' => $this->primaryKey(),
            'outgo_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'quantitu' => $this->integer()->notNull(),
            'price' => $this->decimal(8,2)->notNull(),
        ]);

        // creates index for column `income_id`
        $this->createIndex(
            'idx-outgo_row-outgo_id',
            'outgo_row',
            'outgo_id'
        );
        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-outgo_row-outgo_id',
            'outgo_row',
            'outgo_id',
            'outgo',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('outgo_row');
    }
}
