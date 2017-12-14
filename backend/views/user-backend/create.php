<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserBackend */

$this->title = '创建用户';
$this->params['breadcrumbs'][] = ['label' => 'User Backends', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-create">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
