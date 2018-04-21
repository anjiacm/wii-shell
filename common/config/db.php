<?php
/**
 * Created by PhpStorm.
 * User: anjia
 * Date: 2018/4/11
 * Time: 下午2:03
 */
return [
    // 配置数据库
    'db' => [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=127.0.0.1;dbname=wiidb',
        'username' => 'wga',
        'password' => '123456',
        'charset' => 'utf8mb4',
        'tablePrefix' => 'w_',
        'enableSchemaCache' => false,//true缓存数据库   false不缓存 开发期间介意开false
        'schemaCacheDuration' => 24*3600,
        'schemaCache' => 'cache',
    ],

];