<?php 
if (!defined('THINK_PATH')) exit();

$array  =   array(
    'DB_TYPE'           =>'mysql',
    'DB_HOST'           =>'127.0.0.1',
    'DB_NAME'           =>'tengfang',
    'DB_USER'           =>'root',
    'DB_PWD'            =>'yuyouleon',
    'DB_PORT'           =>'3306',    
    'DB_PREFIX'         =>'',    //表前缀
    //标准URL
    'URL_MODEL'         =>2,       //2 去index
    'APP_DEBUG'         => false, //调试开关
    'HTML_CACHE_ON'     =>  false,       // 默认关闭静态缓存
    'HTML_URL_SUFFIX'   =>'.shtml', 
    'TIME_ZONE'         =>'PRC',
    'APP_DOMAIN_DEPLOY' => false,  //是否布署在根目录下
    'CHECK_FILE_CASE'   => true,  //大小写检查
    'WEB_LOG_RECORD'    => false, //关闭日志
    
    /* 语言设置 */
    'DEFAULT_LANG'      => 'zh-cn', // 默认语言 
    'LANG_SWITCH_ON'    => true,   // 默认关闭多语言包功能
    'LANG_AUTO_DETECT'  => true,   // 自动侦测语言 开启多语言功能后有效
    
    'COOKIE_EXPIRE'     =>  3600 * 24 * 30,     // Cookie有效期
    // 'COOKIE_DOMAIN'     =>  '', // Cookie有效域名
    'COOKIE_PATH'       =>  '/',            // Cookie路径
    'COOKIE_PREFIX'     =>  'h_', // Cookie前缀 避免冲突
    
    'cfg_img_path'      =>  '__PUBLIC__/Upload/',   //上传目录
    'cfg_auth_key'      =>  'uid'   //用户权限控制Key 
);

return $array;