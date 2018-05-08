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
class ProductPropertiesForm extends Model
{
//    public function __construct($x)
//    {
//        $this->{$x} = "dynamic";
//        parent::__construct();
//    }

    public function __construct(array $config = [])
    {
        foreach($config as $k => $value) {
            $this->{$k} = $value;
        }
        parent::__construct($config);
    }


    public $mainCategory;

    public function rules()
    {
        return [
            [['mainCategory','category_id'], 'required'],
            [['mainCategory','category_id'], 'integer'],
        ];
    }


    public function save()
    {
        if ($this->validate()) {
            $product = new Product();
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
            $parentAttr = [];
            $this->category_id = ArrayHelper::index($this->category_id, function ($element) {
                return $element;
            });
            if ($this->parent_id) {
                foreach ($this->parent_id as $item) {
                    $parentAttr[substr($item, 0, stripos($item, '/'))][] =
                        substr($item, stripos($item, '/') + 1, strlen($item));
                }
            }

            foreach ($parentAttr as $key => $value) {
                ArrayHelper::setValue($this->category_id, $key, $value);
            }
//            echo "<pre>";
//            print_r($this);
//            echo "<pre>";die;
//            $transaction = Yii::$app->db->beginTransaction();
//            $attr = new Attr();
            $attr = Attr::findOne($id);
            $attr->title = $this->title;
            $attr->type = $this->type;
            $attr->unit = $this->unit;
            $attr->save();

            CategoryAttr::deleteAll("attr_id = $id");

            foreach ($this->category_id as $key => $category) {
                if (is_array($category)) {
                    foreach ($category as $item) {
                        $categoryAttr = new CategoryAttr();
                        $categoryAttr->category_id = $key;
                        $categoryAttr->attr_id = $attr->id;
                        $categoryAttr->weight = $this->weight;
                        $categoryAttr->parent_id = $item;
                        $categoryAttr->save();
                    }
                } else {
                    $categoryAttr = new CategoryAttr();
                    $categoryAttr->category_id = $key;
                    $categoryAttr->attr_id = $attr->id;
                    $categoryAttr->weight = $this->weight;
                    $categoryAttr->save();
                }
            }
            return $attr->id;
        }
    }



    public function loadAttrData(Attr $attr)
    {
        $this->mainCategory = $attr->getMainCategoryIds();
        $this->title = $attr->title;
        $this->type = $attr->type;
        $this->unit = $attr->unit;
        $this->weight = $attr->getAttrWeight();
        $this->attrId = $attr->id;
        $this->mainCategoryTitle = $attr->getMainCategory();
        $this->subCategoryTitle = $attr->getSubCategories();
        $this->mainAttrsTitle = $attr->getMainAttr();

        return $attr->id;
    }
}