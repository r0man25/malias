<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mainCategory')
        ->dropDownList($parentCategories)->label('Main category')?>

    <?= $form->field($model, 'category_id')
        ->dropDownList($subCategory, ['prompt' => ''])->label('Subcategory')?>

    <?= $form->field($model, 'parent_id')
        ->dropDownList($parentProduct, ['prompt' => ''])->label('Parent product')?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Title')?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'attrs')->checkboxList([])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
