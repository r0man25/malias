<?php

use yii\db\Migration;

/**
 * Handles the creation of table `income`.
 */
class m180517_071555_create_income_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('income', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'date-income' => $this->integer()->notNull(),
            'provider_id' => $this->integer()
        ]);

        // creates index for column `provider_id`
        $this->createIndex(
            'idx-income-provider_id',
            'income',
            'provider_id'
        );
        // add foreign key for table `product`
        $this->addForeignKey(
            'fk-income-provider_id',
            'income',
            'provider_id',
            'provider',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('income');
    }
}
