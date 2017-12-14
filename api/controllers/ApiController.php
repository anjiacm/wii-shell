<?php

namespace api\controllers;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\helpers\Json;
use common\models\WuChanelOne;
use common\models\WuChanelTwo;
use common\models\WuChanelThree;
use common\models\WuChannelFour;
use common\models\WuVersion;
use common\models\WuTjuserall;
use common\models\WuTjuserDau;
use common\models\WuTjchannellist;
use common\models\WuTjAppdown;
class ApiController extends Controller
{
    /*用户新增统计*/
    const KEY='*|2017!qwerasdfzxcv@QWERASDZX#2017$$YRLM.|*_Wu|';
    public function actionUseradd()
    {

        $openkey= empty($_REQUEST['openkey'])?'':$_REQUEST['openkey'];
        $theday= empty($_REQUEST['theday'])?'':$_REQUEST['theday'];
        $key = md5(self::KEY.$theday);
        if($openkey){
            if($key === $openkey){
                $device_id = empty(Yii::$app->request->get('device_id'))?'':Yii::$app->request->get('device_id');
                $version_name = empty(Yii::$app->request->get('version_name'))?'':Yii::$app->request->get('version_name');
                $quedao =empty(Yii::$app->request->get('quedao'))?'':urldecode(Yii::$app->request->get('quedao'));

                /*渠道切割并获取对应数据*/
                $chanel = preg_split('/[_]+/is', $quedao);
                $chanel_one=empty($chanel[0])?'error_lm':trim($chanel[0]);
                $chanel_two=empty($chanel[1])?'error_jh':trim($chanel[1]);
                $chanel_three=empty($chanel[2])?'error_mv':trim($chanel[2]);
                $chanel_four=empty($chanel[3])?'1':trim($chanel[3]);

                /*获取主渠道*/
                $qd_onefind=WuChanelOne::find()->where(['chanle'=>$chanel_one])->one();

                if($qd_onefind){
                    $qd_one=$qd_onefind->id;
                }else{
                    $qd_one=1;
                }
                /*获取计划渠道*/
                $qd_twofind=WuChanelTwo::find()->where(['chanle_web'=>$chanel_two])->one();
                if($qd_twofind){
                    $qd_two=$qd_twofind->id;
                }else{
                    $qd_two=1;
                }
                /*获取影片渠道*/
                $qd_threefind=WuChanelThree::find()->where(['chanle_movie'=>$chanel_three])->one();
                if($qd_threefind){
                    $qd_three=$qd_threefind->id;
                }else{
                    $qd_three=1;
                }

                /*获取uuid渠道*/
                $qd_fourfind=WuChannelFour::find()->where(['chanle_uuid'=>$chanel_four])->one();
                if($qd_fourfind){
                    $qd_four=$qd_fourfind->id;
                }else{
                    $qdfourmodel=new WuChannelFour();
                    $qdfourmodel->chanle_uuid=$chanel_four;
                    $qdfourmodel->dodate=time();
                    $qdfourmodel->save();
                    $qd_four=$qdfourmodel->id;

                }

                /*关联数据存储*/
                $qdlistfind=WuTjchannellist::find()
                    ->where([
                                'one'=>$qd_one,
                                'two'=>$qd_two,
                                'three'=>$qd_three,
                                'four'=>$qd_four,
                            ])
                    ->one();
                if(!$qdlistfind){
                    $qdmodel=new WuTjchannellist();
                    $qdmodel->one=$qd_one;
                    $qdmodel->two=$qd_two;
                    $qdmodel->three=$qd_three;
                    $qdmodel->four=$qd_four;
                    $qdmodel->save();
                }

                /*渠道切割并获取对应数据_end*/
                /*版本查询*/
                $version_name=empty($version_name)?'未知':$version_name;
                $versionfind=WuVersion::find()->where(['version_name'=>$version_name])->one();
                if($versionfind){
                    $versionid=$versionfind->id;
                }else{
                    $versionmodel=new WuVersion;
                    $versionmodel->version_name =$version_name;
                    $versionmodel->dodate =time();
                    $versionmodel->save();
                    $versionid=$versionmodel->id;
                }
                /*版本查询结束*/
                if($device_id){
                    $upmodel=new WuTjuserDau();
                    $userfind=WuTjuserall::find()->where(['device_id'=>$device_id])->one();
                    if($userfind){
                        $upmodel->userid=$userfind->id;
                        $upmodel->quedao=$quedao;
                        $upmodel->device_id=$device_id;
                        $upmodel->version_name=$version_name;
                        $upmodel->dayupdate=time() ;
                        $upmodel->chanel_one=$qd_one;
                        $upmodel->chanel_two=$qd_two;
                        $upmodel->chanel_three=$qd_three;
                        $upmodel->chanel_four=$qd_four;
                        $upmodel->versionid=$versionid;

                        if( $upmodel->save()){
                            $art['code']=0;
                            $art['msg']='更新成功';
                        }else{
                            $art['code']=1;
                            $art['msg']='更新失败';
                        }
                    }else{
                        $usermodel=new WuTjuserall();

                        $usermodel->device_id=$device_id;
                        $usermodel->version_name=$version_name;
                        $usermodel->quedao=$quedao;
                        $usermodel->update=time();
                        $usermodel->chanel_one=$qd_one;
                        $usermodel->chanel_two=$qd_two;
                        $usermodel->chanel_three=$qd_three;
                        $usermodel->chanel_four=$qd_four;
                        $usermodel->versionid=$versionid;
                        $usermodel->save();

                        $upmodel->userid=$usermodel->id;
                        $upmodel->quedao=$quedao;
                        $upmodel->device_id=$device_id;
                        $upmodel->version_name=$version_name;
                        $upmodel->dayupdate=time() ;
                        $upmodel->chanel_one=$qd_one;
                        $upmodel->chanel_two=$qd_two;
                        $upmodel->chanel_three=$qd_three;
                        $upmodel->chanel_four=$qd_four;
                        $upmodel->versionid=$versionid;

                        if( $upmodel->save()){
                            $art['code']=0;
                            $art['msg']='添加成功';
                        }else{
                            $art['code']=1;
                            $art['msg']='添加失败';
                        }
                    }
                }else{
                    $art['code']=119;
                    $art['msg']='我想要的你不给？';
                }
            }else{
                $art['code']=120;
                $art['msg']='发生了什么';
            }
        }else{
            $art['code']=110;
            $art['msg']='请你认真点';
        }
        return Json::encode($art);
    }


    public function actionAppdown()
    {
        $openkey= empty($_REQUEST['openkey'])?'':$_REQUEST['openkey'];
        $theday= empty($_REQUEST['theday'])?'':$_REQUEST['theday'];
        $key = md5(self::KEY.$theday);
        if($openkey){
            if($key === $openkey){
                $device_id = empty(Yii::$app->request->get('device_id'))?'':Yii::$app->request->get('device_id');
                $version_name = empty(Yii::$app->request->get('version_name'))?'':Yii::$app->request->get('version_name');
                $quedao =empty(Yii::$app->request->get('quedao'))?'':urldecode(Yii::$app->request->get('quedao'));

                /*渠道切割并获取对应数据*/
                $chanel = preg_split('/[-_\*]+/is', $quedao);
                $chanel_one=empty($chanel[0])?'error_lm':trim($chanel[0]);
                $chanel_two=empty($chanel[1])?'error_jh':trim($chanel[1]);
                $chanel_three=empty($chanel[2])?'error_mv':trim($chanel[2]);
                $chanel_four=empty($chanel[3])?'1':intval($chanel[3]);

                /*获取主渠道*/
                $qd_onefind=WuChanelOne::find()->where(['chanle'=>$chanel_one])->one();
                if($qd_onefind){
                    $qd_one=$qd_onefind->id;
                }else{
                    $qd_one=1;
                }
                /*获取计划渠道*/
                $qd_twofind=WuChanelTwo::find()->where(['chanle_web'=>$chanel_two])->one();
                if($qd_twofind){
                    $qd_two=$qd_twofind->id;
                }else{
                    $qd_two=1;
                }
                /*获取影片渠道*/
                $qd_threefind=WuChanelThree::find()->where(['chanle_movie'=>$chanel_three])->one();
                if($qd_threefind){
                    $qd_three=$qd_threefind->id;
                }else{
                    $qd_three=1;
                }
                /*获取uuid渠道*/
                $qd_fourfind=WuChannelFour::find()->where(['chanle_uuid'=>$chanel_four])->one();
                if($qd_fourfind){
                    $qd_four=$qd_fourfind->id;
                }else{
                    $qdfourmodel=new WuChannelFour();
                    $qdfourmodel->chanle_uuid=$chanel_four;
                    $qdfourmodel->dodate=time();
                    $qdfourmodel->save();
                    $qd_four=$qdfourmodel->id;

                }
                /*关联数据存储*/
                $qdlistfind=WuTjchannellist::find()
                    ->where([
                        'one'=>$qd_one,
                        'two'=>$qd_two,
                        'three'=>$qd_three,
                        'four'=>$qd_four,
                    ])
                    ->one();
                if(!$qdlistfind){
                    $qdmodel=new WuTjchannellist();
                    $qdmodel->one=$qd_one;
                    $qdmodel->two=$qd_two;
                    $qdmodel->three=$qd_three;
                    $qdmodel->four=$qd_four;
                    $qdmodel->save();
                }

                /*渠道切割并获取对应数据_end*/
                /*版本查询*/
                $version_name=empty($version_name)?'未知':$version_name;
                $versionfind=WuVersion::find()->where(['version_name'=>$version_name])->one();
                if($versionfind){
                    $versionid=$versionfind->id;
                }else{
                    $versionmodel=new WuVersion;
                    $versionmodel->version_name =$version_name;
                    $versionmodel->dodate =time();
                    $versionmodel->save();
                    $versionid=$versionmodel->id;
                }
                /*版本查询结束*/
                if($device_id){
                    $usermodel=new WuTjAppdown();
                    $usermodel->device_id=$device_id;
                    $usermodel->version_name=$version_name;
                    $usermodel->quedao=$quedao;
                    $usermodel->update=time();
                    $usermodel->chanel_one=$qd_one;
                    $usermodel->chanel_two=$qd_two;
                    $usermodel->chanel_three=$qd_three;
                    $usermodel->chanel_four=$qd_four;
                    $usermodel->versionid=$versionid;
                    if($usermodel->save()){
                        $art['code']=0;
                        $art['msg']='添加成功';
                    }else{
                        $art['code']=1;
                        $art['msg']='添加失败';
                    }
                }else{
                    $art['code']=119;
                    $art['msg']='我想要的你不给？';
                }
            }else{
                $art['code']=120;
                $art['msg']='发生了什么';
            }
        }else{
            $art['code']=110;
            $art['msg']='请你认真点';
        }
        return Json::encode($art);
    }











    public function actionApido(){
        $time=time();
        $openkey=md5(self::KEY.$time);



       // $response = ('http://example.com/');
        $url='http://api.ssyy.com/?r=api/useradd&openkey='.$openkey.'&theday='. $time.'&device_id=1117777&version_name=1.1.2&quedao=alm_xf_nqdmq_1111';

        $userinfo = $this->sshttp_get('http://api.ssyy.com/index.php?r=api/useradd&openkey='.$openkey.'&theday='. $time.'&device_id=211217777&version_name=1.1.2&quedao=alm_xf_nqdmq4_12345');
        var_dump( $userinfo);
        exit();


    }

    public static function curl_get_contents($url,$cookie_jar='') {
        $file_content = '';
        if (function_exists('curl_init')) {
            $curl_handle = curl_init();
            curl_setopt($curl_handle, CURLOPT_URL, $url);
            curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT,2);
            curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl_handle, CURLOPT_TIMEOUT, 2);
            curl_setopt($curl_handle, CURLOPT_FAILONERROR,1);
            curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Trackback Spam Check');
            if(!empty($cookie_jar))
            {
                curl_setopt($curl_handle, CURLOPT_COOKIEJAR, $cookie_jar);
                curl_setopt($curl_handle, CURLOPT_COOKIEFILE,$cookie_jar);
            }
            $file_content = curl_exec($curl_handle);
            curl_close($curl_handle);

        } elseif (function_exists('file_get_contents')) {
            $file_content = @file_get_contents($url);
        } elseif (ini_get('allow_url_fopen') && ($file = @fopen($url, 'rb'))){
            $i = 0;
            while (!feof($file) && $i++ < 1000) {
                $file_content .= strtolower(fread($file, 4096));
            }
            fclose($file);
        } else {
            $file_content = '';
        }
        return $file_content;
    }

    private function sshttp_get($url){
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

}
