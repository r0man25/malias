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
class IncomeForm extends Model
{
    public $title;
    public $date_income;
    public $provider_id;


    public function rules()
    {
        return [
            [['title','date_income'], 'required'],
            [['title'], 'string'],
            ['title', 'unique', 'targetClass' => '\backend\models\Income', 'message' => 'This income title has already been taken.'],
            [['date_income'], 'date', 'format' => 'php: Y-m-d', 'message' => 'Date format should be: YYYY-MM-DD'],
            [['provider_id'], 'integer'],
        ];
    }


    public function save()
    {
        if ($this->validate()) {
            $dateIncome = new \DateTime($this->date_income);

            $income = new Income();
            $income->title = $this->title;
            $income->date_income = $dateIncome->getTimestamp();
            $income->provider_id = $this->provider_id;

            if ($income->save()) {
                return $income->id;
            }
            return false;
        }
    }



}