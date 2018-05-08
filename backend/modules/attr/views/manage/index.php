<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Attribute', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Attributes default values', ['/attr/attr-default-values/index'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'type',
            'unit',
            [
                'attribute' => 'Main category',
                'format' => 'raw',
                'value' => function ($data) {
                    $strMainCategory = implode('; ', $data->getMainCategory());
                    return $strMainCategory;
                },
            ],
            [
                'attribute' => 'Subcategory',
                'format' => 'raw',
                'value' => function ($data) {
                    $strSubCategory = implode('; ', $data->getSubCategories());
                    return $strSubCategory;
                },
            ],
            [
                'attribute' => 'Main attribute',
                'format' => 'raw',
                'value' => function ($data) {
                    $strSubCategory = implode('; ', $data->getMainAttr());
                    return $strSubCategory;
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions'   =>   ['class' => 'text-break'],
                'template' => '{view}&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;{delete}&nbsp;&nbsp;&nbsp;{defaultVal}&nbsp;&nbsp;&nbsp;{defaultValInfo}',
                'buttons' => [
                    'defaultVal' => function ($url, $attr) {
                        return Html::a('<span title = "Add default values" class="glyphicon glyphicon-plus"></span>', ['/attr/attr-default-values/create', 'id' => $attr->id]);
                    },
                    'defaultValInfo' => function ($url, $attr) {
                        return Html::a('<span title = "View default values" class="glyphicon glyphicon-info-sign"></span>', ['/attr/attr-default-values/attr-default-values-view', 'id' => $attr->id]);
                    },
                ],
            ],

        ],
    ]); ?>
</div>
