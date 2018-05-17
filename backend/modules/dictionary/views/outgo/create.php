<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OutgoType */

$this->title = 'Create Outgo Type';
$this->params['breadcrumbs'][] = ['label' => 'Dictionary', 'url' => ['/dictionary/manage/index']];
$this->params['breadcrumbs'][] = ['label' => 'Outgo Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outgo-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
