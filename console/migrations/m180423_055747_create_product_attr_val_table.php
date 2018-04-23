<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_attr_val`.
 */
class m180423_055747_create_product_attr_val_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_attr_val', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'attr_id' => $this->integer()->notNull(),
            'val' => $this->string(),
            'attr_val_id' => $this->integer(),
        ]);


        // creates index for column `product_id`
        $this->createIndex(
            'idx-product_attr_val-product_id',
            'product_attr_val',
            'product_id'
        );
        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-product_attr_val-product_id',
            'product_attr_val',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );



        // creates index for column `attr_id`
        $this->createIndex(
            'idx-product_attr_val-attr_id',
            'product_attr_val',
            'attr_id'
        );
        // add foreign key for table `attr`
        $this->addForeignKey(
            'fk-product_attr_val-attr_id',
            'product_attr_val',
            'attr_id',
            'attr',
            'id',
            'CASCADE'
        );


        // creates index for column `attr_val_id`
        $this->createIndex(
            'idx-product_attr_val-attr_val_id',
            'product_attr_val',
            'attr_val_id'
        );
        // add foreign key for table `attr_val`
        $this->addForeignKey(
            'fk-product_attr_val-attr_val_id',
            'product_attr_val',
            'attr_val_id',
            'attr_val',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product_attr_val');
    }
}
