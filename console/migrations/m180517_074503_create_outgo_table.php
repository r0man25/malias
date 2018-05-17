<?php

use yii\db\Migration;

/**
 * Handles the creation of table `outgo`.
 */
class m180517_074503_create_outgo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('outgo', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'date-outgo' => $this->integer()->notNull(),
            'provider_id' => $this->integer(),
            'outgo_type_id' => $this->integer(),
        ]);

        // creates index for column `provider_id`
        $this->createIndex(
            'idx-outgo-provider_id',
            'outgo',
            'provider_id'
        );
        // add foreign key for table `outgo`
        $this->addForeignKey(
            'fk-outgo-provider_id',
            'outgo',
            'provider_id',
            'provider',
            'id',
            'CASCADE'
        );

        // creates index for column `outgo_type_id`
        $this->createIndex(
            'idx-outgo-outgo_type_id',
            'outgo',
            'outgo_type_id'
        );
        // add foreign key for table `outgo`
        $this->addForeignKey(
            'fk-outgo-outgo_type_id',
            'outgo',
            'outgo_type_id',
            'outgo_type',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('outgo');
    }
}
