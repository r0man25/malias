<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Product images: '. $product->brand->title .' '. $product->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->brand->title .' '. $product->title, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="product-form">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php foreach ($productImages as $item): ?>
        <div class="product-image-wrap">

            <?= Html::img(Yii::$app->storage->getFile($item->image),['class' => 'product-image']) ?>

            <div>

                <?php
                    $option = [];
                    $option['value'] = $item->id;
                    $option['class'] = 'check-image';
                    ($item->is_main === 1) ? $option['checked '] = '' : '';
                ?>
                
                <?= $form->field($model, 'isMain[]')->checkbox($option) ?>

                <?= Html::a('Delete', ['delete-image', 'id' => $item->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>

        </div>
    <?php endforeach; ?>


    <?= $form->field($model, 'images[]')->fileInput(['maxlength' => true,'multiple' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerJsFile('@web/js/productImage.js', [
        'depends' => \yii\web\JqueryAsset::className(),
    ]);
?>