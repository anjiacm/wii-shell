<?php
namespace common\components\jssdk;
use common\models\Weichat;
use Yii;
class JSSDK {
    private $appId;
    private $appSecret;

    public function __construct($appId, $appSecret) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        // file_put_contents('./6.txt',$appId.'￥￥++￥￥'.$appSecret,FILE_APPEND); //测试用
    }

    public function getSignPackage($URL) {
        $accetoken=$this->getAccessToken();
        $jsapiTicket = $this->getJsApiTicket();

        //file_put_contents('./5.txt',$this->getAccessToken(),FILE_APPEND); //测试用
        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url =empty($URL)?"$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]":"{$URL}";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->appId,
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string,
            "accetoken" => $accetoken
        );
        return $signPackage;
    }

    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    private function getJsApiTicket() {

        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        //$data = json_decode(file_get_contents("jsapi_ticket.json"));
        $wechatsdb =new Weichat();
        //$wechatin['weichat_appid'] = $this->appId;
        $condition[] = 'and';
        $condition[] = ['=','weichat_appid',$this->appId];

        $findwechatdo = $wechatsdb::find() -> where($condition) -> one();
        $ticket = $findwechatdo['weichat_autoticket'];
        $wtime = isset($findwechatdo['weichat_time']) ? $findwechatdo['weichat_time'] : 0;
        //file_put_contents('./8.txt',$findwechatdo,FILE_APPEND); //测试用
        //exit();
        if ($wtime < time() or !$findwechatdo['weichat_autoticket']) {
            $accessToken = $this->getAccessToken();
            // 如果是企业号用以下 URL 获取 ticket
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            if ($ticket) {
                //$weichat_time = time() + 7200;
                $weichat_autoticket  = $ticket;
                $weichatsavein['weichat_appid'] = $findwechatdo['weichat_appid'];
                $article = Weichat::findOne(['weichat_appid' => $findwechatdo['weichat_appid']]);
                $article->weichat_autoticket =$weichat_autoticket;
                $article->save();

                //	$weichatsave['weichat_time'] =$weichat_time;
                //$weichatsave['weichat_autoticket'] = $weichat_autoticket;
                //$weichatsavedo=$wechatsdb->where($weichatsavein)->save($weichatsave);
//        $data->expire_time = time() + 7200;
//        $data->jsapi_ticket = $ticket;
//        $fp = fopen("jsapi_ticket.json", "w");
//        fwrite($fp, json_encode($data));
//        fclose($fp);
            }
        } else {
            $ticket = $ticket;
        }

        return $ticket;
    }

    private function getAccessToken() {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        // $data = json_decode(file_get_contents("access_token.json"));
        $wechatsdb =new Weichat();
        //$wechatin['weichat_appid'] = $this->appId;
        $condition[] = 'and';
        $condition[] = ['=','weichat_appid',$this->appId];
        $findwechatdo = $wechatsdb::find() -> where($condition) -> one();
        $wtoken = $findwechatdo['weichat_autotoken'];
        $wtime = isset($findwechatdo['weichat_time']) ? $findwechatdo['weichat_time'] : 0;
        //file_put_contents('./8.txt',$findwechatdo,FILE_APPEND); //测试用
        //exit();
        if ($wtime < time()) {
            // 如果是企业号用以下URL获取access_token
            // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
            $res = json_decode($this->httpGet($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $weichat_time = time() + 7200;
                $weichat_autotoken  = $access_token;
                $weichatsavein['weichat_appid'] = $findwechatdo['weichat_appid'];
                $article = Weichat::findOne(['weichat_appid' => $findwechatdo['weichat_appid']]);
                $article->weichat_time =$weichat_time;
                $article->weichat_autoticket ='';
                $article->weichat_autotoken =$weichat_autotoken;
                $article->save();
//                $weichatsave['weichat_time'] =$weichat_time;
//                $weichatsave['weichat_autoticket'] ='';
//                $weichatsave['weichat_autotoken'] =$weichat_autotoken;
//                $weichatsavedo=$wechatsdb->where($weichatsavein)->save($weichatsave);
                // $fp = fopen("access_token.json", "w");
                //  fwrite($fp, json_encode($data));
                //  fclose($fp);
            }
        } else {

            $access_token = $wtoken;
        }
        return $access_token;
    }

    private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
}

