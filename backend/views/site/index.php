<?php

/* @var $this yii\web\View */

$this->title = 'Admin panel';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>MALIAS admin site</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <div class="nav-menu-button">
                    <?= \yii\helpers\Html::a('Categories', '/category/manage/index') ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="nav-menu-button">
                    <?= \yii\helpers\Html::a('Attributes', '/attr/manage/index') ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="nav-menu-button">
                    <?= \yii\helpers\Html::a('Products', '/product/manage/index') ?>
                </div>
            </div>
        </div>

    </div>
</div>
