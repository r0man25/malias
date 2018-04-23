<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m180423_055605_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull(),
            'category_id'=>$this->integer()->notNull(),
            'description'=>$this->text(),
            'parent_id'=>$this->integer(),
        ]);


        // creates index for column `parent_id`
        $this->createIndex(
            'idx-product-parent_id',
            'product',
            'parent_id'
        );
        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product-parent_id',
            'product',
            'parent_id',
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
        $this->dropTable('product');
    }
}
