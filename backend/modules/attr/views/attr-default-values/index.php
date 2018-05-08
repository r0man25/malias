<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

if (Yii::$app->controller->action->id !== "attr-default-values-view") {
    $this->title = 'Attribute default values';
} else {
    (isset($dataProvider->query->one()->attr->title)) ? $title = 'for '.$dataProvider->query->one()->attr->title : $title = "";
    $this->title = 'Default values ' . $title;
}
$this->params['breadcrumbs'][] = ['label' => 'Attributes', 'url' => ['/attr/manage/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-val-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Attr Val', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
        $items = [
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'id',
                'val',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        ];

        if (Yii::$app->controller->action->id !== "attr-default-values-view") {
            array_splice(
                    $items['columns'],
                    2,
                    0,
                    [[
                        'attribute' => 'Attribute',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return $data->attr->title;
                        },
                    ]]
                );
        }
    ?>

    <?= GridView::widget(
        $items
    ); ?>
</div>
