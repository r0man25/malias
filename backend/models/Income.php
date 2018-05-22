<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "income".
 *
 * @property int $id
 * @property string $title
 * @property int $date_income
 * @property int $provider_id
 *
 * @property Provider $provider
 * @property IncomeRow[] $incomeRows
 */
class Income extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'income';
    }

    public static function getNewIncomeTitle()
    {
        $lastModelId = Yii::$app->db->createCommand("
            SELECT `AUTO_INCREMENT`
            FROM  INFORMATION_SCHEMA.TABLES
            WHERE TABLE_SCHEMA = DATABASE()
            AND   TABLE_NAME   = 'income'
        ")->queryScalar();
        return 'Incoming invoice #'.$lastModelId;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'date-income' => 'Date Income',
            'provider_id' => 'Provider ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvider()
    {
        return $this->hasOne(Provider::className(), ['id' => 'provider_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIncomeRows()
    {
        return $this->hasMany(IncomeRow::className(), ['income_id' => 'id']);
    }
}
