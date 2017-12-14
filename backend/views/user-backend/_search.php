<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\UserBackendSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-backend-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'usercard') ?>

    <?= $form->field($model, 'password') ?>

    <?= $form->field($model, 'update_date') ?>

    <?php // echo $form->field($model, 'do_date') ?>

    <?php // echo $form->field($model, 'powerres') ?>

    <?php // echo $form->field($model, 'line_date') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
