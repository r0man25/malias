<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "outgo_type".
 *
 * @property int $id
 * @property string $title
 *
 * @property Outgo[] $outgos
 */
class OutgoType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'outgo_type';
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
    public function getOutgos()
    {
        return $this->hasMany(Outgo::className(), ['outgo_type_id' => 'id']);
    }
}
