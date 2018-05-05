<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Attr */

$this->title = 'Update Attribute: '.$model->title;
$this->params['breadcrumbs'][] = ['label' => 'Attrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $attrId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attr-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parentCategories' => $parentCategories,
        'attrId' => $attrId,
    ]) ?>

    <?php
        $this->registerJsFile('@web/js/subcategories.js', [
            'depends' => \yii\web\JqueryAsset::className(),
        ]);
    ?>

</div>
