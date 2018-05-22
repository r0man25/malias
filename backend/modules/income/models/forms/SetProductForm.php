<?php
namespace backend\modules\income\models\forms;

use backend\models\Income;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
/**
 * Created by PhpStorm.
 * User: us10140
 * Date: 23.04.2018
 * Time: 11:59
 */
class SetProductForm extends Model
{
    public $income;


    public function rules()
    {
        return [
//            [['income'], 'each', 'rule' => ['integer']],
            [['income'], 'checkField'],
        ];
    }

    public function checkField(){
        if(is_array($this->income)){
            foreach ($this->income as $item) {
                $pricePatern = '/^[-]?(([1-9][0-9]*)|(0))([.][0-9]+)?$/';
                if (!preg_match($pricePatern, $item['price'])) {
                    $this->addError('income','Price should be a double');
                }
                $intPattern = '/^[0-9]+$/';
                if (!preg_match($intPattern, $item['mainCategory'])) {
                    $this->addError('income','Main Category should be a integer');
                }
                if (!preg_match($intPattern, $item['category_id'])) {
                    $this->addError('income','Sub Category should be a integer');
                }
                if (!preg_match($intPattern, $item['product_id'])) {
                    $this->addError('income','Product should be a integer');
                }
                if (!preg_match($intPattern, $item['quantitu'])) {
                    $this->addError('income','Quantitu should be a integer');
                }
            }
        } else {
            $this->addError('income','Bad values!');
        }

    }

    public function save()
    {
        if ($this->validate()) {
            echo "<pre>";
            print_r($this);
            echo "</pre>";die;
        }
    }



}