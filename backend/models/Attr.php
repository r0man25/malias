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

        $result = [];
        foreach ($attr as $item) {
            $result[] = [
//                'id' => $item->category->id . '/' . $item->id,
//                'title' => $item->category->title . '/' . $item->attr->title,
                'category_id' => $item->category->id,
                'category_title' => $item->category->title,
                'attr_id' => $item->category->id . '/' . $item->id,
                'attr_title' => $item->attr->title,
            ];
        }
        return $result;
//        return ArrayHelper::map($result, 'id', 'title');
    }


    public static function getMainAttrByCategoryIdWithOutAttrId($id, $attrId = null)
    {
        $attr = CategoryAttr::find()
            ->innerJoin('attr', 'attr.id = category_attr.attr_id')
            ->innerJoin('category', 'category.id = category_attr.category_id')
            ->where(
                [
                    'category_attr.parent_id' => NULL,
                    'category_attr.category_id' => $id,
                ]
            )
            ->andWhere("category_attr.attr_id <> $attrId")
            ->with(['attr', 'category'])
            ->all();

        $result = [];
        foreach ($attr as $item) {
            $result[] = [
                'category_id' => $item->category->id,
                'category_title' => $item->category->title,
                'attr_id' => $item->category->id . '/' . $item->id,
                'attr_title' => $item->attr->title,
            ];
        }
        return $result;
    }


    public function getMainCategoryIds()
    {
        $subCategories = $this->subCategory;
        $mainCategories = [];
        foreach ($subCategories as $subCategory) {
            $mainCategories[] = $subCategory->parent;
        }
        return ArrayHelper::map($mainCategories, 'id', 'id');
    }

    public function getMainCategory()
    {
        $subCategories = $this->subCategory;
        $mainCategories = [];
        foreach ($subCategories as $subCategory) {
            $mainCategories[] = $subCategory->parent;
        }
        return ArrayHelper::map($mainCategories, 'id', 'title');
    }

    public function getSubCategoryIds()
    {
        return ArrayHelper::map($this->subCategory, 'id', 'id');
    }

    public function getSubCategories()
    {
        return ArrayHelper::map($this->subCategory, 'id', 'title');
    }

    public function getMainAttrIds()
    {
        return ArrayHelper::getColumn($this->getCategoryAttrs()->asArray()->all(), 'parent_id');
    }

    public function getMainAttr()
    {
        $attrs = $this->categoryAttrs;
        $mainAttrs = [];

        foreach ($attrs as $mainAttr) {
            if ($mainAttr->parent && !in_array($mainAttr->parent->attr['title'],$mainAttrs)) {
                $mainAttrs[] = $mainAttr->parent->attr['title'];
            }
        }

        return $mainAttrs;
    }

    public static function getAttrs()
    {
        return ArrayHelper::map(self::find()->asArray()->all(),'id','title');
    }


    public function getSubCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('category_attr', ['attr_id' => 'id']);
//            ->viaTable('');
    }


    public function getAttrWeight()
    {
        return ($this->categoryAttrs[0]->weight) ? $this->categoryAttrs[0]->weight : "";
    }

    public static function getAttrsDefaultValByAttrId($id)
    {
        $attrVal = AttrVal::find()->where(['attr_id' => $id])->asArray()->all();
        return ArrayHelper::map($attrVal, 'id', 'val');
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
