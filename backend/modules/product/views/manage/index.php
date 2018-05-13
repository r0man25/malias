<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'Brand',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->brand->title;;
                },
            ],
            'title',
            [
                'attribute' => 'Main Category',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->category->parent->title;;
                },
            ],
            [
                'attribute' => 'Category',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->category->title;;
                },
            ],
            [
                'attribute' => 'Main product',
                'format' => 'raw',
                'value' => function ($data) {
                    return ($data->parent) ? $data->parent->brand->title .' '. $data->parent->title : "";
                },
            ],

//            ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions'   =>   ['class' => 'text-break'],
                'template' => '{view}&nbsp;&nbsp;&nbsp;{update}&nbsp;&nbsp;&nbsp;{delete}&nbsp;&nbsp;&nbsp;{setProperties}&nbsp',
                'buttons' => [
                    'setProperties' => function ($url, $product) {
                        return Html::a('<span title = "Set properties" class="glyphicon glyphicon glyphicon-list-alt"></span>', ['/product/manage/set-product-properties', 'id' => $product->id]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
