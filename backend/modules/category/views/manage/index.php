<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= 'All '.Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Main categories', ['main-categories'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Subcategories', ['subcategories'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => function ($data) {
                    /* @var $post \backend\models\Post */
                    return Html::a($data->id, ['view', 'id' => $data->id]);
                },
            ],
            'title',
            [
                'attribute' => 'Main category',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->parent ? 'ID: '.$data->parent->id.', '.$data->parent->title : '';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
