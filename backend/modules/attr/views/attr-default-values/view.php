<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AttrVal */

$this->title = $model->attr->title;
$this->params['breadcrumbs'][] = ['label' => 'Attributes', 'url' => ['/attr/manage/index']];
$this->params['breadcrumbs'][] = ['label' => 'Attributes default values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-val-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                'attribute' => 'Attribute',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->attr->title;
                },
            ],
            'val',
        ],
    ]) ?>

</div>
