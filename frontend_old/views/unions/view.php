<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Unions */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Unions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_login',
            'user_pass',
            'user_type',
            'user_email:email',
            'user_phone',
            'union_name',
            'union_description',
            'union_create_time:datetime',
            'union_user',
            'union_phone',
            'union_imgs:ntext',
            'status',
            'company_name',
            'company_org',
            'company_org_img',
            'company_license',
            'company_license_img',
            'company_user',
            'company_idcard',
            'company_idcard_img_font',
            'company_idcard_img_back',
            'company_idcard_img_hand',
            'company_size',
            'company_scope',
            'company_phone',
            'bank_name',
            'bank_account',
            'bank_user',
            'bank_phone',
            'bank_img',
            'alipay',
            'wxpay',
            'balance',
            'members',
        ],
    ]) ?>

</div>
