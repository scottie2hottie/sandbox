<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2013 waikucms.com
    
	@function Web组 入口

    @Filename index.php $

    @Author pengyong $

    @Date 2012-12-05 00:59:44 $
*************************************************************/
if(is_dir(dirname(__FILE__).'/Install')){if(!file_exists(dirname(__FILE__).'/Install/install_lock.txt')) header('Location:Install/index.php');}
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//define('APP_DEBUG',TRUE); // 开启调试模式
define('APP_NAME', 'Web');
define('APP_PATH', './Web/'); 
require './Core/Core.php';