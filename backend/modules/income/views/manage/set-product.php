<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Income */

$this->title = 'Set Product Income';
$this->params['breadcrumbs'][] = ['label' => 'Incomes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="income-create">

    <div class="title-wrap">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="btn-add-wrap">
            <div class="btn-add btn btn-info glyphicon glyphicon-plus"></div>
        </div>
    </div>

    <?php $form = ActiveForm::begin(); ?>

    <div id="income-product-wrap">

        <div class="income-product-field">

        <?= $form->field($model, 'income[0][mainCategory]')
            ->dropDownList($parentCategories,['class' => 'form-control main-category','prompt' => ''])->label('Main category')?>

        <?= $form->field($model, 'income[0][category_id]')
            ->dropDownList([], ['class' => 'form-control sub-category','prompt' => '',])->label('Subcategory')?>

        <?= $form->field($model, 'income[0][product_id]')
            ->dropDownList([], ['class' => 'form-control product','prompt' => '',])->label('Product')?>

        <?= $form->field($model, 'income[0][quantitu]')->textInput(['class' => 'form-control quantitu'])->label('Quantity') ?>

        <?= $form->field($model, 'income[0][price]')->textInput(['class' => 'form-control price'])->label('Price') ?>

            <div>
                <div class="btn-rem btn btn-danger glyphicon glyphicon-minus"></div>
            </div>

        </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['id' => 'save-form','class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
    $this->registerJsFile('@web/js/incomeSetProduct.js', [
        'depends' => \yii\web\JqueryAsset::className(),
    ]);
?>
