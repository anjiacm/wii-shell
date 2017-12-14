<?php
use yii\grid\GridView;
backend\assets\WuAsset::register($this);
backend\assets\AppAsset::addScript($this,Yii::$app->request->baseUrl."/css/main.js");
?>
<div class="box box-success">
    <div class="box-header with-border">详细数据</div>
    <div class="box-body bootstrap-table">
        <div class="row margin-bottom">
            <div class="col-md-4">
                <label class="padding-top">本次可结算金额合计：</label>
                <span class="text-muted">（可提现金额=腰果收入/100*分成比例）</span>
            </div>
            <div class="col-md-3 input-group">
                <input type="hidden" id="js-moneyByZBIDs">
                <input id="js-moneyByZB" type="text" class="form-control text-red" value="" placeholder="请选择需要结算的主播" disabled>
                <span class="input-group-btn">
                                    <button type="button" class="btn btn-success btn-flat">一键结算</button>
                                </span>
            </div>
        </div>
        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                // 数据提供者中所含数据所定义的简单的列
                // 使用的是模型的列的数据
                'id',
                'content',
                // 更复杂的列数据
                [
                    'class' => 'yii\grid\DataColumn', //由于是默认类型，可以省略
                    'value' => function ($data) {
                        return $data->content; // 如果是数组数据则为 $data['name'] ，例如，使用 SqlDataProvider 的情形。
                    },
                ],
            ],
        ]);
        ?>
    </div>
</div>