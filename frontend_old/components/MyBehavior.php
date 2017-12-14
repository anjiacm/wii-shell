<?php
namespace frontend\components;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
class MyBehavior extends \yii\base\ActionFilter
{
    public function beforeAction ($action)
    {

        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create','view','update','delete','logout', 'signup'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];

    }

    public function isGuest ()
    {
        return Yii::$app->user->isGuest;
    }


}