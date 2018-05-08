<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AttrVal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attr-val-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (Yii::$app->controller->action->id === "update" || !($model->attr_id)): ?>
        <?= $form->field($model, 'attr_id')->dropDownList($attrs)->label('Attribute') ?>
    <?php endif; ?>

    <?= $form->field($model, 'val')->textInput(['maxlength' => true])->label('Value') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
