<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UnionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Unions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unions-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Unions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_login',
            'user_pass',
            'user_type',
            'user_email:email',
            // 'user_phone',
            // 'union_name',
            // 'union_description',
            // 'union_create_time:datetime',
            // 'union_user',
            // 'union_phone',
            // 'union_imgs:ntext',
            // 'status',
            // 'company_name',
            // 'company_org',
            // 'company_org_img',
            // 'company_license',
            // 'company_license_img',
            // 'company_user',
            // 'company_idcard',
            // 'company_idcard_img_font',
            // 'company_idcard_img_back',
            // 'company_idcard_img_hand',
            // 'company_size',
            // 'company_scope',
            // 'company_phone',
            // 'bank_name',
            // 'bank_account',
            // 'bank_user',
            // 'bank_phone',
            // 'bank_img',
            // 'alipay',
            // 'wxpay',
            // 'balance',
            // 'members',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
