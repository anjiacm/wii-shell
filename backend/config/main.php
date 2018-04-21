<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
//        'admin' => [
//            'class' => 'mdm\admin\Module',
//        ],
        'rbac' => [
            'class' => 'rbac\Module',
        ],
        //......
    ],
    'aliases' => [
       // '@mdm/admin' => '@vendor/mdmsoft/yii2-admin',
        '@rbac' => '@backend/modules/rbac',
    ],
    'as access' => [
        'class' => 'rbac\components\AccessControl',
        'allowActions' => [

            //这里是允许访问的action，不受权限控制
            //controller/action
        ]
    ],
    'as MyBehavior' => backend\components\MyBehavior::className(),
    'components' => [

        'helper' => [
            'class' => 'common\components\Helper',
            'property' => '123',
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-black',
                ],

            ],
            'appendTimestamp' => true,
        ],

        'user' => [
            'identityClass' => 'backend\models\UserBackend',
            'enableAutoLogin' => true,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => true,
            'enableStrictParsing' => false,
            'suffix' => '',
            'rules' => [
                '<controller:\w+>/<action:\w+>/<page:\d+>' => '<controller>/<action>',
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>",
            ],
        ],
    ],

    // 配置语言
    'language'=>'zh-CN',
    // 配置时区
    'timeZone'=>'Asia/Chongqing',
    'params' => $params,
];
