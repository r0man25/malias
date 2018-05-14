<?php
namespace backend\modules\product\models\forms;
use backend\models\Product;
use backend\models\ProductAttrVal;
use Yii;
use backend\models\Attr;
use backend\models\CategoryAttr;
use yii\base\Model;
use yii\helpers\ArrayHelper;
/**
 * Created by PhpStorm.
 * User: us10140
 * Date: 23.04.2018
 * Time: 11:59
 */
class ProductForm extends Model
{
    public $mainCategory;
    public $category_id;
    public $parent_id;
    public $brand_id;
    public $title;
    public $description;
    public $attrs;
    public $product_id;


    public function rules()
    {
        return [
            [['mainCategory','category_id','brand_id'], 'required'],
            [['mainCategory','category_id'], 'integer'],
            [['parent_id'], 'integer'],
            [['brand_id'], 'integer'],
            [['title'], 'required'],
            [['title'], 'string', 'min' => 2],
            [['description'], 'string'],
            [['attrs'], 'each', 'rule' => ['integer']],
        ];
    }


    public function save()
    {
        if ($this->validate()) {
            $product = new Product();
            $product->brand_id = $this->brand_id;
            $product->title = $this->title;
            $product->category_id = $this->category_id;
            $product->parent_id = $this->parent_id;
            $product->description = $this->description;
            $product->save();

            foreach ($this->attrs as $attr) {
                $productAttrVal = new ProductAttrVal();
                $productAttrVal->product_id = $product->id;
                $productAttrVal->attr_id = $attr;
                $productAttrVal->save();
            }

            return $product->id;
        }
    }



    public function update($id)
    {
        if ($this->validate()) {
            $this->attrs = ArrayHelper::index($this->attrs,function ($element) {
                return $element;
            });
            $product = Product::findOne($id);
            $product->brand_id = $this->brand_id;
            $product->title = $this->title;
            $product->category_id = $this->category_id;
            $product->parent_id = $this->parent_id;
            $product->description = $this->description;
            $product->save();

            $productAttrVal = ProductAttrVal::find()->where(['product_id' => $id])->all();
            foreach ($productAttrVal as $item) {
                if (!in_array($item->attr_id, $this->attrs)) {
                    $item->delete();
                } else {
                    ArrayHelper::remove($this->attrs,$item->attr_id);
                }
            }

            foreach ($this->attrs as $attr) {
                $productAttrVal = new ProductAttrVal();
                $productAttrVal->product_id = $product->id;
                $productAttrVal->attr_id = $attr;
                $productAttrVal->save();
            }
            return $product->id;
        }
    }



    public function loadProductData(Product $product)
    {
        $this->mainCategory = $product->category->parent;
        $this->category_id = $product->category_id;
        $this->parent_id = $product->parent_id;
        $this->brand_id = $product->brand_id;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->product_id = $product->id;

        return $product->id;
    }
}