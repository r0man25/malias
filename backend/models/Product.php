<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property string $description
 * @property int $parent_id
 * @property int $brand_id
 *
 * @property Category $category
 * @property Product $parent
 * @property Product[] $products
 * @property ProductAttrVal[] $productAttrVals
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['category_id', 'parent_id'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'parent_id' => 'Parent ID',
        ];
    }

    public static function getParentProductsAsArray()
    {
        $parentProduct = self::find()->where(['parent_id' => NULL])->asArray()->all();
        return ArrayHelper::map($parentProduct, 'id', 'title');
    }

    public function getAttrs()
    {
        return $this->productAttrVals;
    }

    public function getAttrsAsArray()
    {
        return ArrayHelper::map($this->productAttrVals,'attr_id','attr_id');
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::className(), ['id' => 'brand_id']);
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
        return $this->hasOne(Product::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttrVals()
    {
        return $this->hasMany(ProductAttrVal::className(), ['product_id' => 'id']);
    }

    public function getImages()
    {
        return $this->hasMany(ProductImage::className(), ['product_id' => 'id']);
    }

    public function getMainImage()
    {
        $productImage = $this->getImages()->where('is_main = 1')->one();
        return (isset($productImage->image)) ? Yii::$app->storage->getFile($productImage->image) : Yii::$app->storage->getFile('no-image.png');
    }


    public static function getProductsByCategoryId($id, $productsArr = [])
    {
        return ArrayHelper::map(self::find()->where(['category_id' => $id])->andWhere(['not in','id',$productsArr])->asArray()->all(),'id','title');
    }
}
