<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $title
 * @property int $parent_id
 *
 * @property Category $parent
 * @property Category[] $categories
 * @property CategoryAttr[] $categoryAttrs
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'parent_id' => 'Parent ID',
        ];
    }


    public static function getParentCategoriesAsArray()
    {
        $parentCategory = self::find()->where(['parent_id' => NULL])->asArray()->all();
        return ArrayHelper::map($parentCategory, 'id', 'title');
    }

    public static function getSubcategoriesByCategoryId($id)
    {
        $subCategories = self::find()->where(['parent_id' => $id])->asArray()->all();
        return ArrayHelper::map($subCategories, 'id', 'title');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Category::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttrs()
    {
        return $this->hasMany(CategoryAttr::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
}
