<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
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
                        <h3 class="title-group gfont-1">Create an Account</h3>
                    </div>
                </div>
            </div>
            <div class="account-create">

                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="account-create-box">
                                <h2 class="box-info">Personal Information</h2>
                                <div class="row">
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="single-create">
                                            <p>Username <sup>*</sup></p>
                                            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="single-create">
                                            <p>Email Address <sup>*</sup></p>
                                            <?= $form->field($model, 'email')->label(false) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="account-create-box">
                                <h2 class="box-info">Login Information</h2>
                                <div class="row">
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="single-create">
                                            <p>Password <sup>*</sup></p>
                                            <?= $form->field($model, 'password')->passwordInput()->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="single-create">
                                            <p>Confirm Password <sup>*</sup></p>
                                            <?= $form->field($model, 'confirmPassword')->passwordInput()->label(false) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="submit-area">
                                <p class="required text-right">* Required Fields</p>
                                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary floatright', 'name' => 'signup-button']) ?>
                                <a href="<?= Yii::$app->request->referrer ?>" class="float-left"><span><i
                                                class="fa fa-angle-double-left"></i></span> Back</a>
                            </div>
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