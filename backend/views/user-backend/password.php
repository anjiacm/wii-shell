<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\WuChanelOne;
/* @var $this yii\web\View */
/* @var $model backend\models\UserBackend */

$this->title = '密码设置' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Backends', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-backend-update">

    <div class="user-backend-form">
        <?php $form = ActiveForm::begin([
            'id' => 'test-id',
        ]); ?>


        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'usercard')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'password')->textInput(['value'=>'']) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? '添加' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
