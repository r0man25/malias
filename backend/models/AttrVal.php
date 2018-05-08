<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "attr_val".
 *
 * @property int $id
 * @property int $attr_id
 * @property string $val
 *
 * @property Attr $attr
 * @property ProductAttrVal[] $productAttrVals
 */
class AttrVal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attr_val';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attr_id', 'val'], 'required'],
            [['attr_id'], 'integer'],
            [['val'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attr_id' => 'Attr ID',
            'val' => 'Val',
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
    public function getProductAttrVals()
    {
        return $this->hasMany(ProductAttrVal::className(), ['attr_val_id' => 'id']);
    }
}
