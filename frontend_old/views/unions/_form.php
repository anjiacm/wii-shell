<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Unions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="unions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_pass')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_type')->textInput() ?>

    <?= $form->field($model, 'user_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'union_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'union_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'union_create_time')->textInput() ?>

    <?= $form->field($model, 'union_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'union_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'union_imgs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_org')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_org_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_license')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_license_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_idcard')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_idcard_img_font')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_idcard_img_back')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_idcard_img_hand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_size')->textInput() ?>

    <?= $form->field($model, 'company_scope')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_user')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alipay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wxpay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'members')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
