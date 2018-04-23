<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Attr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')
            ->dropDownList($categories, ['prompt' => ''])->label('Main category');?>

    <?= Html::dropDownList('main-category', [], [
        '/attr/manage/like' => 'asd'
    ]) ?>




    <br><br><br><br><br>
<!--    --><?//= $form->field($model, 'category_id')
//        ->dropDownList($categories, ['prompt' => ''])->label('Subcategory');?>
<!---->
<!--    --><?//= $form->field($model, 'parent_id')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
