<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;


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
            'category_id' => 'Category ID',
        ];
    }


    public static function getMainAttrByCategoryId($id)
    {
        $attr = CategoryAttr::find()
            ->innerJoin('attr', 'attr.id = category_attr.attr_id')
            ->innerJoin('category', 'category.id = category_attr.category_id')
            ->where(
                [
                    'category_attr.parent_id' => NULL,
                    'category_attr.category_id' => $id
                ]
            )
            ->with(['attr', 'category'])
            ->all();

//        return $attr;

        $result = [];
        foreach ($attr as $item) {
            $result[] = [
                'id' => $item->id,
                'title' => $item->category->title . '/' . $item->attr->title,
            ];
        }

        return ArrayHelper::map($result, 'id', 'title');
    }


    public function getMainCategory()
    {
        return $this->subCategory->parent;
    }


    public function getSubCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id'])
            ->viaTable('category_attr', ['attr_id' => 'id']);
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
