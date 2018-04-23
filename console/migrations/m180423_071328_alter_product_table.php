<?php

use yii\db\Migration;

/**
 * Class m180423_071328_alter_product_table
 */
class m180423_071328_alter_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // creates index for column `category_id`
        $this->createIndex(
            'idx-product-category_id',
            'product',
            'category_id'
        );
        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-product-category_id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `categotry`
        $this->dropForeignKey(
            'fk-product-category_id',
            'product'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-product-category_id',
            'product'
        );
    }
}
