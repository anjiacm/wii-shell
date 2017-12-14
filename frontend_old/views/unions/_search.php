<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UnionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_login') ?>

    <?= $form->field($model, 'user_pass') ?>

    <?= $form->field($model, 'user_type') ?>

    <?= $form->field($model, 'user_email') ?>

    <?php // echo $form->field($model, 'user_phone') ?>

    <?php // echo $form->field($model, 'union_name') ?>

    <?php // echo $form->field($model, 'union_description') ?>

    <?php // echo $form->field($model, 'union_create_time') ?>

    <?php // echo $form->field($model, 'union_user') ?>

    <?php // echo $form->field($model, 'union_phone') ?>

    <?php // echo $form->field($model, 'union_imgs') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'company_name') ?>

    <?php // echo $form->field($model, 'company_org') ?>

    <?php // echo $form->field($model, 'company_org_img') ?>

    <?php // echo $form->field($model, 'company_license') ?>

    <?php // echo $form->field($model, 'company_license_img') ?>

    <?php // echo $form->field($model, 'company_user') ?>

    <?php // echo $form->field($model, 'company_idcard') ?>

    <?php // echo $form->field($model, 'company_idcard_img_font') ?>

    <?php // echo $form->field($model, 'company_idcard_img_back') ?>

    <?php // echo $form->field($model, 'company_idcard_img_hand') ?>

    <?php // echo $form->field($model, 'company_size') ?>

    <?php // echo $form->field($model, 'company_scope') ?>

    <?php // echo $form->field($model, 'company_phone') ?>

    <?php // echo $form->field($model, 'bank_name') ?>

    <?php // echo $form->field($model, 'bank_account') ?>

    <?php // echo $form->field($model, 'bank_user') ?>

    <?php // echo $form->field($model, 'bank_phone') ?>

    <?php // echo $form->field($model, 'bank_img') ?>

    <?php // echo $form->field($model, 'alipay') ?>

    <?php // echo $form->field($model, 'wxpay') ?>

    <?php // echo $form->field($model, 'balance') ?>

    <?php // echo $form->field($model, 'members') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
