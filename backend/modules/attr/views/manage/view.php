<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Attr */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Attrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->attrId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->attrId], [
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
            [
                'attribute' => 'id',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->attrId;
                },
            ],
            [
                'attribute' => 'Main category',
                'format' => 'raw',
                'value' => function ($data) {
                    $strMainCategory = implode('; ', $data->mainCategoryTitle);
                    return $strMainCategory;
                },
            ],
            [
                'attribute' => 'Subcategory',
                'format' => 'raw',
                'value' => function ($data) {
                    $strSubCategory = implode('; ', $data->subCategoryTitle);
                    return $strSubCategory;
                },
            ],
            [
                'attribute' => 'Main attributes',
                'format' => 'raw',
                'value' => function ($data) {
                    $strMainAttrs = implode('; ', $data->mainAttrsTitle);
                    return $strMainAttrs;
                },
            ],
            'title',
            'type',
            'unit',
            [
                'attribute' => 'Weight',
                'format' => 'raw',
                'value' => function ($data) {
                    return $data->weight;
                },
            ],
        ],
    ]) ?>

</div>
