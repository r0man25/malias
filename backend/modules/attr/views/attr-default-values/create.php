<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AttrVal */

$this->title = 'Create default value for attribute: '.$attrTitle;
$this->params['breadcrumbs'][] = ['label' => 'Attributes', 'url' => ['/attr/manage/index']];
$this->params['breadcrumbs'][] = ['label' => 'Attributes default values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-val-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'attrs' => $attrs,
    ]) ?>

</div>
