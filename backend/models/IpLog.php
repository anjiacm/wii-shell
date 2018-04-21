<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%ip_log}}".
 *
 * @property integer $id
 * @property string $ip_all
 * @property string $ip_res
 * @property string $dodate
 * @property integer $errsum
 * @property string $usercard
 * @property string $userpwd
 */
class IpLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ip_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['errsum'], 'integer'],
            [['ip_all', 'ip_res', 'dodate', 'usercard', 'userpwd'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip_all' => 'ip段',
            'ip_res' => '当前ip',
            'dodate' => '操作日期',
            'errsum' => '错误次数',
            'usercard' => '登录账号',
            'userpwd' => '登录密码',
        ];
    }
}
