<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Attr */

$this->title = 'Create Attr';
$this->params['breadcrumbs'][] = ['label' => 'Attrs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attr-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
