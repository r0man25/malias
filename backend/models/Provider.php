<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "provider".
 *
 * @property int $id
 * @property string $title
 *
 * @property Income[] $incomes
 * @property Outgo[] $outgos
 */
class Provider extends \yii\db\ActiveRecord
{
    public static function getProvidersAsArray()
    {
        return ArrayHelper::map(self::find()->asArray()->all(),'id','title');
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncomes()
    {
        return $this->hasMany(Income::className(), ['provider_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutgos()
    {
        return $this->hasMany(Outgo::className(), ['provider_id' => 'id']);
    }
}
