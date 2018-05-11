<?php

use yii\db\Migration;

/**
 * Handles the creation of table `brand`.
 */
class m180511_060328_create_brand_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('brand', [
            'id' => $this->primaryKey(),
            'title'=>$this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('brand');
    }
}
