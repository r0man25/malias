<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = 'Update Product: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parentCategories' => $parentCategories,
        'subCategory' => $subCategory,
        'parentProduct' => $parentProduct,
        'brands' => $brands,
    ]) ?>

</div>

<?php
$this->registerJsFile('@web/js/product.js', [
    'depends' => \yii\web\JqueryAsset::className(),
]);
?>
