<?php

use yii\db\Migration;

/**
 * Class m180511_060345_alter_product_table
 */
class m180511_060345_alter_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'brand_id', $this->integer());

        // creates index for column `attr_val_id`
        $this->createIndex(
            'idx-product-brand_id',
            'product',
            'brand_id'
        );
        // add foreign key for table `attr_val`
        $this->addForeignKey(
            'fk-product-brand_id',
            'product',
            'brand_id',
            'brand',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-product-brand_id','{{%product}}');
        $this->dropIndex('idx-product-brand_id','{{%product}}');
        $this->dropColumn('{{%product}}', 'brand_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180511_060345_alter_product_table cannot be reverted.\n";

        return false;
    }
    */
}
