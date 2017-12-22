<?php
namespace backend\models;
use Yii;
use yii\base\Model;
use backend\models\UserBackend;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $usercard;
    public $email;
    public $password;
    public $created_at;
    public $updated_at;
    public $passwordnew;
    /**
     * @inheritdoc
     * 对数据的校验规则
     */
    public function rules()
    {
        return [
            // 对username的值进行两边去空格过滤
            [['username', 'usercard'], 'filter', 'filter' => 'trim'],
            // required表示必须的，也就是说表单提交过来的值必须要有, message 是username不满足required规则时给的提示消息
            ['username', 'required', 'message' => '用户名不可以为空'],
            ['usercard', 'required', 'message' => '账号不可以为空'],
            // unique表示唯一性，targetClass表示的数据模型 这里就是说UserBackend模型对应的数据表字段username必须唯一
            ['username', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => '用户名已存在.'],
            ['usercard', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => '账号已存在.'],
            // string 字符串，这里我们限定的意思就是username至少包含2个字符，最多255个字符
            [['username', 'usercard'], 'string', 'min' => 2, 'max' => 255],
            // 下面的规则基本上都同上，不解释了
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required', 'message' => '邮箱不可以为空'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\UserBackend', 'message' => 'email已经被设置了.'],
            [['password','passwordnew'], 'required', 'message' => '密码不可以为空'],
            [['password','passwordnew'], 'string', 'min' => 6, 'tooShort' => '密码至少填写6位'],
            // default 默认在没有数据的时候才会进行赋值
            [['created_at', 'updated_at'], 'default', 'value' => time()],
        ];
    }

    /**
     * Signs user up.
     *
     * @return true|false 添加成功或者添加失败
     */
    public function signup()
    {
        // 调用validate方法对表单数据进行验证，验证规则参考上面的rules方法，如果不调用validate方法，那上面写的rules就完全是废的啦
        if (!$this->validate()) {
            return null;
        }
        // 实现数据入库操作
        $user = new UserBackend();
        $user->username = $this->username;
        $user->usercard = $this->usercard;
        $user->email = $this->email;
        $user->do_date = $this->created_at;
        $user->line_date = $this->updated_at;
        // 设置密码，密码肯定要加密，暂时我们还没有实现，继续阅读下去，我们在下面有实现
        $user->setPassword($this->password);
        // 生成 "remember me" 认证key
        $user->generateAuthKey();
        // save(false)的意思是：不调用UserBackend的rules再做校验并实现数据入库操作
        // 这里这个false如果不加，save底层会调用UserBackend的rules方法再对数据进行一次校验，这是没有必要的。
        // 因为我们上面已经调用Signup的rules校验过了，这里就没必要再用UserBackend的rules校验了
        return $user->save(false);
    }

    public function changePassword(){
        $id = YII::$app->user->id;
        $admin=  UserBackend::findIdentity($id);
        $password = $admin->password;

        if(Yii::$app->getSecurity()->validatePassword($this->password, $password)){
            $newPass = Yii::$app->getSecurity()->generatePasswordHash($this->passwordnew);
            $admin->password = $newPass;
            if($admin->save()){
                Yii::$app->session->setFlash('success','保存成功');
                return true;
            }else{
                Yii::$app->session->setFlash('error','保存失败');
                return false;
            }
        }else{
            Yii::$app->session->setFlash('error','旧密码错误');
            return false;
        }
    }
}