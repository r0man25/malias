<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Update Product: '.$product->brand->title.' '.$product->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->brand->title.' '.$product->title, 'url' => ['view', 'id' => $product->id]];
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
