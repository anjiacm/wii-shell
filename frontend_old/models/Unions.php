<?php

namespace frontend\models;

use Yii;
use yii\web\IdentityInterface;
use mdm\admin\models\Assignment as adminAssignment;
/**
 * This is the model class for table "cmf_unions".
 *
 * @property integer $id
 * @property string $user_login
 * @property string $user_pass
 * @property integer $user_type
 * @property string $user_email
 * @property string $user_phone
 * @property string $union_name
 * @property string $auth_key
 * @property string $user_last_ip
 * @property integer $user_last_time
 * @property string $union_description
 * @property integer $union_create_time
 * @property string $union_user
 * @property string $union_phone
 * @property string $union_imgs
 * @property integer $status
 * @property string $company_name
 * @property string $company_org
 * @property string $company_org_img
 * @property string $company_license
 * @property string $company_license_img
 * @property string $company_user
 * @property string $company_idcard
 * @property string $company_idcard_img_font
 * @property string $company_idcard_img_back
 * @property string $company_idcard_img_hand
 * @property integer $company_size
 * @property string $company_scope
 * @property string $company_phone
 * @property string $bank_name
 * @property string $bank_account
 * @property string $bank_user
 * @property string $bank_phone
 * @property string $bank_img
 * @property string $alipay
 * @property string $wxpay
 * @property string $balance
 * @property integer $members
 */
class Unions extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cmf_unions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type', 'union_create_time','user_last_time', 'status', 'company_size', 'members'], 'integer'],
            [['union_imgs'], 'string'],
            [['balance'], 'number'],
            [['user_login'], 'string', 'max' => 60],
            [['user_pass'], 'string', 'max' => 64],
            [['user_email', 'company_name', 'company_org', 'company_license'], 'string', 'max' => 100],
            [['user_phone', 'union_phone', 'company_phone','user_last_ip', 'bank_phone'], 'string', 'max' => 15],
            [['union_name','auth_key', 'union_description', 'company_org_img', 'company_license_img', 'company_idcard_img_font', 'company_idcard_img_back', 'company_idcard_img_hand', 'company_scope', 'bank_img'], 'string', 'max' => 255],
            [['union_user', 'company_user'], 'string', 'max' => 20],
            [['company_idcard'], 'string', 'max' => 18],
            [['bank_name', 'bank_user', 'alipay', 'wxpay'], 'string', 'max' => 50],
            [['bank_account'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_login' => 'User Login',
            'user_pass' => 'User Pass',
            'user_type' => 'User Type',
            'user_email' => 'User Email',
            'user_phone' => 'User Phone',
            'union_name' => 'Union Name',
            'union_description' => 'Union Description',
            'union_create_time' => 'Union Create Time',
            'union_user' => 'Union User',
            'union_phone' => 'Union Phone',
            'union_imgs' => 'Union Imgs',
            'status' => 'Status',
            'company_name' => 'Company Name',
            'company_org' => 'Company Org',
            'company_org_img' => 'Company Org Img',
            'company_license' => 'Company License',
            'company_license_img' => 'Company License Img',
            'company_user' => 'Company User',
            'company_idcard' => 'Company Idcard',
            'company_idcard_img_font' => 'Company Idcard Img Font',
            'company_idcard_img_back' => 'Company Idcard Img Back',
            'company_idcard_img_hand' => 'Company Idcard Img Hand',
            'company_size' => 'Company Size',
            'company_scope' => 'Company Scope',
            'company_phone' => 'Company Phone',
            'bank_name' => 'Bank Name',
            'bank_account' => 'Bank Account',
            'bank_user' => 'Bank User',
            'bank_phone' => 'Bank Phone',
            'bank_img' => 'Bank Img',
            'alipay' => 'Alipay',
            'wxpay' => 'Wxpay',
            'balance' => 'Balance',
            'members' => 'Members',
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
        $this->user_pass = Yii::$app->security->generatePasswordHash($password);
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
    public static function findByUsername($username)
    {
        return static::findOne(['user_login' => $username]);
    }
    /**
     * 验证密码的准确性
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {

        return $this->user_pass === md5($password);
//        var_dump($password);
//        exit();
//        return Yii::$app->security->validatePassword($password, $this->user_pass);
    }

//    public function  afterSave($insert, $changedAttributes)
//    {
//        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
//        if($insert){
//            $item=[self::ASSINGMAN];
//            $model=new adminAssignment($this->id);
//            $model->assign($item);
//        }
//    }
}
