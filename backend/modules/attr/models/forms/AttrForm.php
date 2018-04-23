<?php

namespace backend\modules\attr\models\forms;

use backend\models\Attr;
use yii\base\Model;
/**
 * Created by PhpStorm.
 * User: us10140
 * Date: 23.04.2018
 * Time: 11:59
 */
class AttrForm extends Model
{
    public $category_id;
    public $parent_id;
    public $title;
    public $unit;
    public $weight;

    public function rules()
    {
        return [
            [['category_id'], 'required'],
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



    public function save()
    {
        return true;
    }

}