<?php
namespace common\models;

use Yii;
use yii\base\Model;
use backend\models\UserBackend as User;
use backend\models\IpLog;
/**
 * Login form
 */
class LoginForm extends Model
{
    public $usercard;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['usercard', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            $ipmodel=new IpLog();
            $usercard = $this->usercard;
            $password = $this->password;
            $ip_res=Yii::$app->request->userIP;
            $ipStr = explode('.',$ip_res);
            $ip_all =  $ipStr[0].'.'.$ipStr[1].'.'.$ipStr[2];
            $result=IpLog::find()
                ->where([
                    'ip_all'=>$ip_all,
                ])
                ->one();
            if($result){
                $result->errsum+=1;
                $result->dodate=date('Y-m-d H:i:s');
                $result->save();
            }else{
                $ipmodel->dodate=date('Y-m-d H:i:s');
                $ipmodel->usercard=$usercard;
                $ipmodel->userpwd=$password;
                $ipmodel->errsum=1;
                $ipmodel->ip_all=$ip_all;
                $ipmodel->ip_res=$ip_res;
                $ipmodel->save();
            }
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->usercard);
        }

        return $this->_user;
    }
}
