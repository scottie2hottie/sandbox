<?php
$config= require './Public/Config/config.ini.php';
$admin_config=array(
	'URL_MODEL'             => 0,
	'TMPL_CACHE_ON' => false,//�ر�ģ�建��
	'TMPL_ACTION_ERROR'     => 'Public:error', // Ĭ�ϴ�����ת��Ӧ��ģ���ļ�
    'TMPL_ACTION_SUCCESS'   => 'Public:success', // Ĭ�ϳɹ���ת��Ӧ��ģ���ļ�
);
return array_merge($config,$admin_config);
?>