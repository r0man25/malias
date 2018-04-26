<?php

namespace backend\modules\attr\models\forms;

use Yii;
use backend\models\Attr;
use backend\models\CategoryAttr;
use yii\base\Model;
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
            [['mainCategory'], 'required'],
            [['mainCategory'], 'each', 'rule' => ['integer']],
//            [['category_id'], 'required'],
            [['category_id'], 'integer'],
            [['parent_id'], 'integer'],
            [['title'], 'required'],
            [['title'], 'string', 'min' => 2],
            [['type'], 'required'],
            [['type'], 'string', 'min' => 2],
            [['unit'], 'string'],
            [['weight'], 'integer'],
        ];
    }



    public function toInt(&$arr)
    {
        foreach ($arr as &$item)
        {
            $item = (int) $item;
        }
    }


    public function save()
    {

//        $this->toInt($this->mainCategory);

        
        if ($this->validate()) {
            echo "<pre>";
            var_dump($this);
            echo "</pre>";die;
            $transaction = Yii::$app->db->beginTransaction();

            $attr = new Attr();
            $categoryAttr = new CategoryAttr();

            echo "<pre>";
            print_r($this);
            echo "</pre>";die;

            $attr->title = $this->title;
            $attr->type = $this->type;
            $attr->unit = $this->unit;

            $attr->save();

//            $categoryAttr->category_id = $this->category_id;
//            $categoryAttr->attr_id = $attr->id;
//            $categoryAttr->weight = $this->weight;
//            $categoryAttr->parent_id = $this->parent_id;

            if ($categoryAttr->save()) {
                $transaction->commit();
            }






            $transaction->rollBack();
        }
    }


    public function loadAttr(Attr $attr)
    {
        $this->mainCategory = $attr->getMainCategory();
        $this->category_id = $attr->subCategory;
        $this->parent_id = $attr->subCategory;
    }

}