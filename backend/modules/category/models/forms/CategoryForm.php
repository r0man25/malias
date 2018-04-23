<?php

namespace backend\modules\category\models\forms;

use backend\models\Category;
use yii\base\Model;
/**
 * Created by PhpStorm.
 * User: us10140
 * Date: 23.04.2018
 * Time: 11:59
 */
class CategoryForm extends Model
{
    public $title;
    public $parent_id;

    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'min' => 2],

            [['parent_id'], 'integer'],
        ];
    }



    public function save()
    {
        if ($this->validate()) {
            $category = new Category();

            $category->title = $this->title;
            $category->parent_id = $this->parent_id;

            if ($category->save()) {
                return $category;
            }
        }
    }

}