<?php

namespace backend\modules\attr\models\forms;

use function Symfony\Component\Debug\Tests\testHeader;
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
class AttrForm extends Model
{
    public $mainCategory;
    public $category_id;
    public $parent_id;
    public $title;
    public $type;
    public $unit;
    public $weight;

    public function rules()
    {
        return [
            [['mainCategory','category_id'], 'required'],
            [['mainCategory','category_id'], 'each', 'rule' => ['integer']],
            [['parent_id'], 'each', 'rule' => ['match', 'pattern' => '/^[0-9]+\/[0-9]+$/']],
            [['title'], 'required'],
            [['title'], 'string', 'min' => 2],
            [['type'], 'required'],
            [['type'], 'string', 'min' => 2],
            [['unit'], 'string'],
            [['weight'], 'integer'],
        ];
    }


    public function save()
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

            $attr = new Attr();
            $attr->title = $this->title;
            $attr->type = $this->type;
            $attr->unit = $this->unit;
            $attr->save();

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

//            if ($categoryAttr->save()) {
//                $transaction->commit();
//            }
//            $transaction->rollBack();
        }
    }


    public function loadAttr(Attr $attr)
    {
        $this->mainCategory = $attr->getMainCategory();
        $this->category_id = $attr->subCategory;
        $this->parent_id = $attr->subCategory;
    }

}