<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Attr */
/* @var $parentCategories backend\models\Category getParentCategoriesAsArray */

$this->title = 'Create Attribute';
$this->params['breadcrumbs'][] = ['label' => 'Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'parentCategories' => $parentCategories,
//        'subCategories' => $subCategories,
    ]) ?>

    <?php
        $this->registerJsFile('@web/js/attr.js', [
            'depends' => \yii\web\JqueryAsset::className(),
        ]);
    ?>

</div>
