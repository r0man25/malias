<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180423_055621_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull(),
            'parent_id'=>$this->integer(),
        ]);


        // creates index for column `parent_id`
        $this->createIndex(
            'idx-category-parent_id',
            'category',
            'parent_id'
        );
        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-category-parent_id',
            'category',
            'parent_id',
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
        $this->dropTable('category');
    }
}
