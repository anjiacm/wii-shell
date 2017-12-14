WII-CMS
===============================
基于YII2框架开发。这个版本主要是外壳。此版本中主要区别是根据白狼栈教程在yii2框架下载后：
增加了  rbac管理模式和bootstrap下的后台模板。
增加了  gii的定制模板 定制模块名见backend/commposer/components/gii-custom

安装方法
-------------------
```
git  clone https://github.com/anjiacm/wii-shell.git

```
然后通过composer(没有安装过的可以参考这个：http://www.yiichina.com/tutorial/324)
如果已经装过composer的话就更新下
```
composer  self-update
php composer.phar global require "fxp/composer-asset-plugin:1.0.0"(准备所有插件！！非常重要，少了这步一切都会失败)
```
然后进入根目录 
```
composer install

```

注意点：我这个版本不知道为什么不能下载linslin/yii2-curl
这个主要是api curl 用   如果有需要可以直接去git上下载
或者composer
```
composer  require --prefer-dist linslin/yii2-curl "*"
```

关于yii2有啥问题的可以参考网站：http://www.manks.top/  白狼栈
如果有啥意见意见可以联系QQ 546167337  安大人