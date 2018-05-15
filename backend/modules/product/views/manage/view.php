<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = $model->brand->title.' '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Properties', ['set-product-properties', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Images', ['image', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
                'attribute' => 'Main product',
                'format' => 'raw',
                'value' => function ($data) {
                    return ($data->parent) ? $data->parent->brand->title .' '. $data->parent->title : "";
                },
            ],
            [
                'attribute' => 'Main image',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::img($data->getMainImage(), ['width' => '400px']);
                },
            ],
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
            'description:ntext',
        ],
    ]) ?>

</div>
