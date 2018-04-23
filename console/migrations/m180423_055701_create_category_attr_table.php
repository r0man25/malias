<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_attr`.
 */
class m180423_055701_create_category_attr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category_attr', [
            'id' => $this->primaryKey(),
            'category_id'=>$this->integer()->notNull(),
            'attr_id'=>$this->integer()->notNull(),
            'weight'=>$this->integer(),
            'parent_id'=>$this->integer(),
        ]);

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-category_attr-parent_id',
            'category_attr',
            'parent_id'
        );
        // add foreign key for table `category_attr`
        $this->addForeignKey(
            'fk-category_attr-parent_id',
            'category_attr',
            'parent_id',
            'category_attr',
            'id',
            'CASCADE'
        );


        // creates index for column `category_id`
        $this->createIndex(
            'idx-category_attr-category_id',
            'category_attr',
            'category_id'
        );
        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-category_attr-category_id',
            'category_attr',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );



        // creates index for column `attr_id`
        $this->createIndex(
            'idx-category_attr-attr_id',
            'category_attr',
            'attr_id'
        );
        // add foreign key for table `attr`
        $this->addForeignKey(
            'fk-category_attr-attr_id',
            'category_attr',
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
        $this->dropTable('category_attr');
    }
}
