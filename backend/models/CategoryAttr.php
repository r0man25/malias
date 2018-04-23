<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "category_attr".
 *
 * @property int $id
 * @property int $category_id
 * @property int $attr_id
 * @property int $weight
 * @property int $parent_id
 *
 * @property Attr $attr
 * @property Category $category
 * @property CategoryAttr $parent
 * @property CategoryAttr[] $categoryAttrs
 */
class CategoryAttr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_attr';
    }

//    /**
//     * @inheritdoc
//     */
//    public function rules()
//    {
//        return [
//            [['category_id', 'attr_id'], 'required'],
//            [['category_id', 'attr_id', 'weight', 'parent_id'], 'integer'],
//            [['attr_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attr::className(), 'targetAttribute' => ['attr_id' => 'id']],
//            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
//            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryAttr::className(), 'targetAttribute' => ['parent_id' => 'id']],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'attr_id' => 'Attr ID',
            'weight' => 'Weight',
            'parent_id' => 'Parent ID',
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
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(CategoryAttr::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryAttrs()
    {
        return $this->hasMany(CategoryAttr::className(), ['parent_id' => 'id']);
    }
}
