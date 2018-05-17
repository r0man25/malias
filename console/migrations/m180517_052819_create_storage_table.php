<?php

use yii\db\Migration;

/**
 * Handles the creation of table `storage`.
 */
class m180517_052819_create_storage_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('storage', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->unique()->notNull(),
            'quantity' => $this->integer(),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-storage-product_id',
            'storage',
            'product_id'
        );
        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-storage-product_id',
            'storage',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('storage');
    }
}
