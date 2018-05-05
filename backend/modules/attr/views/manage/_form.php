<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Attr */
/* @var $form yii\widgets\ActiveForm */
/* @var $parentCategories backend\models\Category getParentCategoriesAsArray */
?>

<div class="attr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'mainCategory')
        ->checkboxList($parentCategories, ['data-id' => (isset($attrId)) ? $attrId : ''])
        ->label('Main category');?>

    <?= $form->field($model, 'category_id')
            ->checkboxList([])
            ->label(false)?>

    <?= $form->field($model, 'parent_id')
            ->checkboxList([])
            ->label(false) ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label('Attribute name') ?>

    <?= $form->field($model, 'type')
            ->dropDownList(Yii::$app->params['attrType'], ['prompt' => ''])->label('Attribute type') ?>

    <?= $form->field($model, 'unit')->textInput(['maxlength' => true])->label('Attribute unit') ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true])->label('Attribute weight') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
