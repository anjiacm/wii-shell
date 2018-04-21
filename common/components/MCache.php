<?php
/**
 * Created by PhpStorm.
 * User: mwg
 * Date: 2018/2/11 10:32
 */

namespace common\components;
use console\models\Item\GfUser;
use console\models\Item\GfzfyService;

use console\models\service\WxUser;
use Yii;
use api\components\Constant;
class MCache
{
    public static function addMem($prefix,$arr)
    {
        // 获取当前最大值
        $intMaxID = intval(Yii::$app->cache->get($prefix.'_max')) + 1;
        // 写入内存
        $cachename = Yii::$app->cache->set($prefix.'_max', $intMaxID, 86400);
        $cachelog = Yii::$app->cache->set($prefix.'_'.$intMaxID, $arr, 86400);
        if($cachename and $cachelog){
            return true;
        }else{
            $code = Constant::STATUS_cache_error;
            $msg=Constant::getStatusItems(Constant::STATUS_cache_error);
            Helper::result($code,$msg);
        }
    }
    public static function addToDB($prefix)
    {
        // 获取最大值、当前位置
        $intMaxId = intval(Yii::$app->cache->get($prefix.'_max'));
        $intCurId = intval(Yii::$app->cache->get($prefix.'_cur'));
        //echo $intCurId.'-'.$intMaxId."\r\n";
        if ($intMaxId <= $intCurId) {
            //echo date('Y-m-d H:i:s') . " maxid:{$intMaxId}<=curid:{$intCurId}\n";
            return false;
        }
        // 计算执行范围
        $int_vlog_begin = $intCurId + 1;
        $int_vlog_end = $intCurId + 5000;
        //echo $int_vlog_begin.'-'.$int_vlog_end.'-'.$intMaxId."<br>";
        if ($intMaxId < $int_vlog_end)
            $int_vlog_end = $intMaxId;
        // 写入数据库
        echo 'writelog:' . $int_vlog_begin . '-' . $int_vlog_end . "\n";
        for ($i = $int_vlog_begin; $i <= $int_vlog_end; $i++) {
            $params = Yii::$app->cache->get($prefix.'_' . $i);
            if ($params) {
                //print_r($params);
                if($prefix=='wx_user'){
                    WxUser::LookFor($params);
                }elseif($prefix == 'gfzfy'){
                    GfzfyService::Gfzfyadd($params);
                }elseif($prefix == 'wx_user_guangfa'){
                    GfUser::LookFor($params);
                }

                Yii::$app->cache->delete($prefix.'_' . $i);
            }
            $intCurId = $i;
        }
        Yii::$app->cache->set($prefix.'_cur', $intCurId, 86400);

        // 自动重新计数
        if ($int_vlog_end >= 1000000000) {
            Yii::$app->cache->delete($prefix.'_max');
            sleep(30);
            $currMaxId = Yii::$app->cache->get($prefix.'_max');
            if ($currMaxId >= 1000000000) {
                Yii::$app->cache->delete($prefix.'_max');
            }
            Yii::$app->cache->delete($prefix.'_cur');
            echo date('Y-m-d H:i:s') . " flush\n";
        }
    }
}