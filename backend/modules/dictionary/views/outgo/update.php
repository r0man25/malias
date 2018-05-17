<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OutgoType */

$this->title = 'Update Outgo Type: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dictionary', 'url' => ['/dictionary/manage/index']];
$this->params['breadcrumbs'][] = ['label' => 'Outgo Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="outgo-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
