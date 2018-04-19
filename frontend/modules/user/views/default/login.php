<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model frontend\modules\user\models\forms\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>



<!-- START PAGE-CONTENT -->
<br><br>
<section class="page-content">
    <!-- Start Account-Create-Area -->
    <div class="account-create-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="area-title">
                        <h3 class="title-group gfont-1">Login</h3>
                    </div>
                </div>
            </div>
            <br>
            <div class="account-create">

                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="single-create">
                                    <p>Email Address <sup>*</sup></p>
                                    <?= $form->field($model, 'email')->textInput(['autofocus' => true])->label(false) ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="single-create">
                                    <p>Password <sup>*</sup></p>
                                    <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="single-create">
                                    <?= $form->field($model, 'rememberMe')->checkbox() ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 col-xs-12">
                                <div class="single-create">
                                    If you forgot your password you can <?= Html::a('reset it', ['/user/default/request-password-reset']) ?>
                                </div>
                            </div>
                        </div>

                        <div class="submit-area">
                            <p class="required text-right">* Required Fields</p>
                            <?= Html::submitButton('Login', ['class' => 'btn btn-primary floatright', 'name' => 'login-button']) ?>
                            <a href="<?= Yii::$app->request->referrer ?>" class="float-left"><span><i
                                            class="fa fa-angle-double-left"></i></span> Back</a>
                        </div>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <!-- End Account-Create-Area -->
</section>
<!-- END PAGE-CONTENT -->
<br><br><br><br><br>




