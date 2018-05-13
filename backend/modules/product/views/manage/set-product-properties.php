<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Attr;


/* @var $this yii\web\View */
/* @var $model backend\models\Product */

$this->title = 'Set Product Properties for '. $productTitle;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $productTitle, 'url' => ['view', 'id' => $productId]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="product-form">

        <?php $form = ActiveForm::begin(); ?>

        <?php foreach ($productAttrs as $prop) : ?>

            <?php if ($attrVal = Attr::getAttrsDefaultValByAttrId($prop->attr_id)) : ?>
                <?= $form->field($model, "propDefaultVals[$prop->id]")
                    ->dropDownList($attrVal)->label($prop->attr->title)?>
            <?php else: ?>
                <?= $form->field($model, "prop[$prop->id]")->textInput(['maxlength' => true])
                    ->label($prop->attr->title)?>
            <?php endif; ?>

        <?php endforeach; ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
