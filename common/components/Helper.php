<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/18
 * Time: 16:27
 */
namespace common\components;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Json;
class Helper
{
    public static function checkedMobile($mobile)
    {
        return $mobile;
    }

    //AES加解密
//@param text 要解密的内容
//@param yzm 验证码
//@param key = md5($yzm); 密钥key的长度必须16，32位,这里直接验证码MD5来处理
//@param vi  向量
    private function AESDecryptEx($text,$key,$iv){
        $text = base64_decode($text);
        $decode = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $text, MCRYPT_MODE_CBC, $iv);
        return $decode;
    }

//AES加解密
    public static function pkcs5Unpad($text) {
        $pad = ord($text{strlen($text) - 1});
        if ($pad > strlen($text)) return false;
        if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
        return substr($text, 0, -1 * $pad);
    }
    public static function pkcs5Pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }
    public static function AESmcryptencrypt($dataint){
        $AESKEY = Yii::$app->params['AESKEY'];
        $IV = Yii::$app->params['IV'];
        $data = $dataint;
        $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128,MCRYPT_MODE_CBC);
        $mingwenpass = self::pkcs5Pad($data,$size);
        $decryptdata = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $AESKEY, $mingwenpass, MCRYPT_MODE_CBC, $IV);
        return base64_encode($decryptdata);
    }
//解密
    public static function AESmcryptdecrypt($dataint){
        $AESKEY = Yii::$app->params['AESKEY'];
        $IV = Yii::$app->params['IV'];
        $data = $dataint;
        $postdata = base64_decode($data);
        $decryptdata = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $AESKEY, $postdata, MCRYPT_MODE_CBC, $IV);
        $mingwenpass = self::pkcs5Unpad($decryptdata);
        return $mingwenpass;
    }
    /*获取常量对应数据*/
    public static function getItems($items, $key = null,$throw=false)
    {
        if ($key !== null){
            if (isset($items[$key])){
                return $items[$key];
            }
            if($throw){
                throw new InvalidParamException();
            }
            return 'unknown key:' . $key;
        }
        return $items;
    }
    /*调取json 返回  不写日志版本*/
    public static function result($code = 1, $msg='', $data = array())
    {
        $art['ret'] = $code;
        $art['msg'] = $msg;
        if ($data) {
            $art['data'] = $data;
        }
        echo Json::encode($art);
        Yii::$app->end();
    }

    /*调取json 返回  不写日志版本*/
    public static function result_noend($code = 1, $msg='', $data = array())
    {
        $art['ret'] = $code;
        $art['msg'] = $msg;
        if ($data) {
            $art['data'] = $data;
        }
        echo Json::encode($art);
    }

    /*调取json 返回  写日志版本*/
    public static function result_log($code = 1, $msg='', $data = array())
    {
        $art['ret'] = $code;
        $art['msg'] = $msg;
        if ($data) {
            $art['data'] = $data;
        }
        //todo  save log
        echo Json::encode($art,"UTF-8");
        self::save_log($art);
        Yii::$app->end();
    }
    //文件写入
    public static function save_log($msg)
    {
        $msg = Json::encode($msg);
        $dir = dirname(Yii::$app->basePath).DIRECTORY_SEPARATOR.'logs';
        if(!is_dir($dir)){
            mkdir($dir);
        }
        $logFile = $excelpath = dirname(Yii::$app->basePath).DIRECTORY_SEPARATOR.'logs' . DIRECTORY_SEPARATOR . date('Y-m-d') . '.txt';
        $msg = date('Y-m-d H:i:s') . ' >>> ' . $msg . "\r\n";
        $msg .=Json::encode($_REQUEST)."\r\n";
        file_put_contents($logFile, $msg, FILE_APPEND);
    }

    /*empty 方法*/
    public static function empty_me($data,$err=''){
        $res = empty($data)?$err:$data;
        return $res;
    }
    /**
     * GET 请求
     * @param string $url
     */
    public static function sshttp_get($url){
        $oCurl = curl_init();
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);
        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200){
            return $sContent;
        }else{
            return false;
        }
    }
    /**
     * POST 请求
     * @param string $url
     */
    public static function httppost($url,$param){
        $oCurl = curl_init();
        if(stripos($url,"https://")!==FALSE){
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, false);
        }
        if (is_string($param)) {
            $strPOST = $param;
        } else {
            $aPOST = array();
            foreach($param as $key=>$val){
                $aPOST[] = $key."=".urlencode($val);
            }
            $strPOST =  join("&", $aPOST);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($oCurl, CURLOPT_POST,true);
        curl_setopt($oCurl, CURLOPT_POSTFIELDS,$strPOST);
        $sContent = curl_exec($oCurl);
        $aStatus = curl_getinfo($oCurl);

        curl_close($oCurl);
        if(intval($aStatus["http_code"])==200){
            return $sContent;
        }else{
            return false;
        }
    }

    //判断脚本是否重复执行
    public static function Scriptresdo($strName, $intNum = 1)
    {
        set_time_limit(0);
        // 定义将要运行的语句
        $strExec = '';
        $isReturn = true;
        $strExec = "ps -ef | grep php | grep '{$strName}' | grep -v grep | grep -v '>>' | wc -l";
        $count = exec($strExec);
        echo "thread:" . ($count - 1) . "\tpid:" . getmypid() . "\n";
        if($count > $intNum)
        {
            $isReturn = false;
        }
        return $isReturn;
    }

}