<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_image`.
 */
class m180514_072013_create_product_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_image', [
            'id' => $this->primaryKey(),
            'product_id'=>$this->integer()->notNull(),
            'image'=>$this->string()->notNull(),
            'is_main'=>$this->integer(1),
        ]);

        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_image-product_id',
            'product_image',
            'product_id'
        );
        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_image-product_id',
            'product_image',
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
        $this->dropTable('product_image');
    }
}
