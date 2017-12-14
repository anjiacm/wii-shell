<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserBackendSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-backend-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('新增用户', ['create'], [
            'class' => 'btn btn-success',
            'id' => 'create',
            'data-toggle' => 'modal',
            'data-target' => '#operate-modal',
        ]) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'usercard',
            'password',

            [
                "attribute" => "do_date",
                "value" => function ($model) {
                    return date('Y-m-d H:00',$model->do_date);
                },
                "format" => "raw",
            ],
            // 'do_date',
            // 'powerres',
            // 'line_date',
            // 'email:email',
            // 'auth_key',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {password} {delete}',
                "buttons" => [

                    "update" => function ($url, $model, $key) {
                        //$url =Url::to(['rbac/assignment/view','id'=>$model->id]);
                        return Html::a("编辑", $url, [
                                "title" => "编辑",
                                'class' => 'btn btn-success btn-update',
                                'data-toggle' => 'modal',
                                'data-target' => '#operate-modal',
                            ]
                        );
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('删除', $url, [
                            'title' => '删除',
                            'class' => 'btn btn-default',
                            'data' => [
                                'confirm' => '确定要删除么?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                    'password' => function ($url, $model, $key) {
                        return Html::a('修改密码', $url, [
                            'title' => '修改密码',
                            'class' => 'btn btn-danger btn-password ',
                            'data-toggle' => 'modal',
                            'data-target' => '#operate-modal',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
<?php
// 创建modal
Modal::begin([
    'id' => 'operate-modal',
    'header' => '<h4 class="modal-title"></h4>',
]);
Modal::end();
// 创建
$requestCreateUrl = Url::toRoute('create');
// 更新
$requestUpdateUrl = Url::toRoute('update');
$requestPasswordUrl = Url::toRoute('password');
$js = <<<JS
     // 创建操作
    $('#create').on('click', function () {
        $('.modal-title').html('创建');
        $.get('{$requestCreateUrl}',
            function (data) {
                 $('.modal-body').html(data);
            }
        );
    });
    // 更新操作
    $('.btn-update').on('click', function () {
        $('.modal-title').html('编辑');
        $.get('{$requestUpdateUrl}', { id: $(this).closest('tr').data('key') },
            function (data) {
                $('.modal-body').html(data);
            }
        );
    });
     // 更新操作
    $('.btn-password').on('click', function () {
        $('.modal-title').html('密码设置');
        $.get('{$requestPasswordUrl}', { id: $(this).closest('tr').data('key') },
            function (data) {
                $('.modal-body').html(data);
            }
        );
    });
JS;
$this->registerJs($js);

?>
