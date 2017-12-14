<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<section class="invoice">
    <!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i> WII 后台
                <small class="pull-right">时间:<?= date('Y-m-d')?></small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            开发者
            <address>
                <strong>W.g.a</strong><br>
                <br>
                Phone: 18815239392<br>
                Email: 546167337@qq.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            登录用户:
            <address>
                <strong><?php  echo Yii::$app->user->identity->username?></strong><br>
                <br>
                管理员类型:<?php  echo Yii::$app->user->identity->user_type?><br>
                上次登录时间:<?php  echo date('Y-m-d H:i:s',Yii::$app->user->identity->line_date)?><br>

            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>系统信息</b><br>
            <br>
            <b>PHP版本:</b><?php echo PHP_VERSION?><br>
            <b>系统环境:</b> <?php echo php_sapi_name()?><br>

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>版本号</th>
                    <th>更新时间</th>
                    <th>更新内容</th>

                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>v.1.0</td>
                    <td>2017-12-05</td>
                    <td>第一次上线</td>

                </tr>

                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->


    <!-- this row will not appear when printing -->

</section>
