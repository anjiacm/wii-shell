<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Unions */

$this->title = 'Update Unions: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Unions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="unions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
