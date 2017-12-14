<?php

namespace backend\models;

use Yii;
use yii\web\IdentityInterface;
use rbac\models\Assignment as adminAssignment;
/**
 * This is the model class for table "w_user_backend".
 *
 * @property integer $id
 * @property string $username
 * @property string $usercard
 * @property string $password
 * @property integer $update_date
 * @property integer $do_date
 * @property integer $powerres
 * @property integer $line_date
 * @property string $email
 * @property string $auth_key
 * @property string $user_type
 * @property string $lmid
 * @property string $cpashow
 */
class UserBackend extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    //public $user_type;
    //const ASSINGMAN ='角色-超级管理员';
    public static function tableName()
    {
        return 'w_user_backend';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'usercard'], 'filter', 'filter' => 'trim'],
            // required表示必须的，也就是说表单提交过来的值必须要有, message 是username不满足required规则时给的提示消息
            ['username', 'required', 'message' => '用户名不可以为空'],
            ['usercard', 'required', 'message' => '账号不可以为空'],
            // unique表示唯一性，targetClass表示的数据模型 这里就是说UserBackend模型对应的数据表字段username必须唯一
            ['username', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => '用户名已存在.'],
            ['usercard', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => '账号已存在.'],
            // string 字符串，这里我们限定的意思就是username至少包含2个字符，最多255个字符
            [['username', 'usercard','user_type'], 'string', 'min' => 2, 'max' => 255],
            // 下面的规则基本上都同上，不解释了
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => '邮箱不可以为空'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => 'email已经被设置了.'],
            ['password', 'required', 'message' => '密码不可以为空'],
            ['password', 'string', 'min' => 6, 'tooShort' => '密码至少填写6位'],
            // default 默认在没有数据的时候才会进行赋值

            [['do_date', 'line_date','update_date'], 'default', 'value' => time()],
            [['lmid','cpashow'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'usercard' => '登陆账号',
            'password' => '密码',
            'update_date' => '更新时间',
            'do_date' => '注册时间',
            'powerres' => '状态',
            'line_date' => '上次登录时间',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'user_type'=>'管理员类型',
            'lmid'=>'所属联盟',
            'cpashow'=>'CPA显示设置',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     * 根据access_token获取用户，我们暂时先不实现，我们在文章 http://www.manks.top/yii2-restful-api.html 有过实现，如果你感兴趣的话可以先看看
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     * 用以标识 Yii::$app->user->id 的返回值
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }


    /**
     * @inheritdoc
     * 获取auth_key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     * 验证auth_key
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    public function updatePassword($password)
    {
        return $this->password = Yii::$app->security->generatePasswordHash($password);
    }
    /**
     * 生成 "remember me" 认证key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * 根据user_backend表的username获取用户
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($usercard)
    {
        return static::findOne(['usercard' => $usercard]);
    }
    /**
     * 验证密码的准确性
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function  afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub

            $admintype=$this->user_type;
            $item=[$admintype];
            $model=new adminAssignment($this->id);
            $model->assign($item);

    }




}
