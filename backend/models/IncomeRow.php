<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "income_row".
 *
 * @property int $id
 * @property int $income_id
 * @property int $product_id
 * @property int $quantitu
 * @property string $price
 *
 * @property Income $income
 */
class IncomeRow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'income_row';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['income_id', 'product_id', 'quantitu', 'price'], 'required'],
            [['income_id', 'product_id', 'quantitu'], 'integer'],
            [['price'], 'number'],
            [['income_id'], 'exist', 'skipOnError' => true, 'targetClass' => Income::className(), 'targetAttribute' => ['income_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'income_id' => 'Income ID',
            'product_id' => 'Product ID',
            'quantitu' => 'Quantitu',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncome()
    {
        return $this->hasOne(Income::className(), ['id' => 'income_id']);
    }
}
