<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Test asset bundle.
 */
class WuAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       // 'js/datatables/bootstrap-table.css',
        'js/daterangepicker/daterangepicker.css',
        'js/search/dist/css/bootstrap-select.css',
        'css/mycss.css'
      //  '//cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css',
      //  '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css',
    ];
    public $js = [
        'js/echarts.min.js',
        'js/daterangepicker/moment.min.js',
        'js/daterangepicker/daterangepicker.js',
       // 'js/datatables/bootstrap-table.js',
        //'js/datatables/bootstrap-table-zh-CN.min.js',

        'js/search/dist/js/bootstrap-select.js'
    ];
    public $depends = [
        'backend\assets\AppAsset'
    ];

}