<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "attr".
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $unit
 *
 * @property AttrVal[] $attrVals
 * @property CategoryAttr[] $categoryAttrs
 * @property ProductAttrVal[] $productAttrVals
 */
class Attr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attr';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type' => 'Type',
            'unit' => 'Unit',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttrVals()
    {
        return $this->hasMany(AttrVal::className(), ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttrs()
    {
        return $this->hasMany(CategoryAttr::className(), ['attr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttrVals()
    {
        return $this->hasMany(ProductAttrVal::className(), ['attr_id' => 'id']);
    }
}
