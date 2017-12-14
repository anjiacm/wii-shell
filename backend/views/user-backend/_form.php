<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\UserBackend */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-backend-form">
    <?php $form = ActiveForm::begin([
        'id' => 'test-id',
    ]); ?>


    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usercard')->textInput(['maxlength' => true]) ?>

    <?= $model->isNewRecord ?$form->field($model, 'password')->textInput(['value'=>'']):'' ?>

    <?= $form->field($model, 'powerres')->dropDownList(['1'=>'正常','0'=>'禁用']) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    </script>