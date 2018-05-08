<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AttrVal */

$this->title = 'Update default attribute value: '.$model->val;
$this->params['breadcrumbs'][] = ['label' => 'Attributes', 'url' => ['/attr/manage/index']];
$this->params['breadcrumbs'][] = ['label' => 'Attributes default values', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->val, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attr-val-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'attrs' => $attrs,
    ]) ?>

</div>
