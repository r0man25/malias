<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Provider */

$this->title = 'Update Provider: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Dictionary', 'url' => ['/dictionary/manage/index']];
$this->params['breadcrumbs'][] = ['label' => 'Providers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="provider-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>