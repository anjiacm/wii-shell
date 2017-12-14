<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Unions */

$this->title = 'Create Unions';
$this->params['breadcrumbs'][] = ['label' => 'Unions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
