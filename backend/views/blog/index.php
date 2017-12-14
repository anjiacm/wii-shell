<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;
backend\assets\WuAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blogs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
        if(Helper::checkRoute('create')) {
            echo Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']);
        }  ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content',
            'views',
            'is_delete',
            [
                "attribute" => "dateall",
                "value" => function ($date) {

                    return $date->id;
                },
                "format" => "raw",
            ],
            // 'created_at',
            // 'vpdated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                "header" => "操作",


                'template' => Helper::filterActionColumn('{view}{update}{delete}{update-status}'),
                "buttons" => [
                    "update-status" => function () {
                        return Html::a("更新状态", "javascript:;", ["onclick"=>"update_status(this, 1);"]); },
                ],
            ],
        ],
    ]); ?>
</div>
    <div id="zhexian" style="width: 100%;height:300px;margin-top: 0px;">

    </div>
<?php $this->beginBlock("myjs") ?>

        function update_status(abj,type){
            console.log(11);

        }
    var myChart = echarts.init(document.getElementById('zhexian'));
    option = {
    tooltip : {
    trigger: 'axis'
    },
    legend: {
    data:['邮件营销','联盟广告','视频广告','直接访问','搜索引擎']
    },
    toolbox: {
    show : true,
    feature : {
    mark : {show: true},
    dataView : {show: true, readOnly: false},
    magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
    restore : {show: true},
    saveAsImage : {show: true}
    }
    },
    calculable : true,
    xAxis : [
    {
    type : 'category',
    boundaryGap : false,
    data : ['周一','周二','周三','周四','周五','周六','周日']
    }
    ],
    yAxis : [
    {
    type : 'value'
    }
    ],
    series : [
    {
    name:'邮件营销',
    type:'line',
    stack: '总量',
    data:[120, 132, 101, 134, 90, 230, 210]
    },
    {
    name:'联盟广告',
    type:'line',
    stack: '总量',
    data:[220, 182, 191, 234, 290, 330, 310]
    },
    {
    name:'视频广告',
    type:'line',
    stack: '总量',
    data:[150, 232, 201, 154, 190, 330, 410]
    },
    {
    name:'直接访问',
    type:'line',
    stack: '总量',
    data:[320, 332, 301, 334, 390, 330, 320]
    },
    {
    name:'搜索引擎',
    type:'line',
    stack: '总量',
    data:[820, 932, 901, 934, 1290, 1330, 1320]
    }
    ]
    };

    myChart.setOption(option);
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["myjs"], \yii\web\View::POS_END); ?>