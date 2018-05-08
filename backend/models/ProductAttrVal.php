<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product_attr_val".
 *
 * @property int $id
 * @property int $product_id
 * @property int $attr_id
 * @property string $val
 * @property int $attr_val_id
 *
 * @property Attr $attr
 * @property AttrVal $attrVal
 * @property Product $product
 */
class ProductAttrVal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_attr_val';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'attr_id'], 'required'],
            [['product_id', 'attr_id', 'attr_val_id'], 'integer'],
            [['val'], 'string', 'max' => 255],
            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attr::className(), 'targetAttribute' => ['attr_id' => 'id']],
            [['attr_val_id'], 'exist', 'skipOnError' => true, 'targetClass' => AttrVal::className(), 'targetAttribute' => ['attr_val_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'attr_id' => 'Attr ID',
            'val' => 'Val',
            'attr_val_id' => 'Attr Val ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttr()
    {
        return $this->hasOne(Attr::className(), ['id' => 'attr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrVal()
    {
        return $this->hasOne(AttrVal::className(), ['id' => 'attr_val_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
