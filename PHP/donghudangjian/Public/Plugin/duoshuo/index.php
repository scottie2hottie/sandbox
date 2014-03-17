<?php
class duoshuoPlugin extends Plugin
{
	static function index()
	{
		$plugin = new Plugin();
		$plugin->assign('config',$plugin->config());
		return $plugin->display();
	}
	/* ��ȡ��˵��������  */
	static function comment()
	{
		return "<span class=\"ds-thread-count\" data-thread-key=\"".C('COOKIE_PREFIX').$GLOBALS['_fields']['id']."\" data-count-type=\"comments\"></span>";
	}
	
	/* ��ȡ��˵������΢��ת����  */
	static function weibo()
	{
		return "<span class=\"ds-thread-count\" data-thread-key=\"".C('COOKIE_PREFIX').$GLOBALS['_fields']['id']."\" data-count-type=\"weibo_reposts\"></span>";
	}
	
	/* ��ȡ��˵��qq΢��ת����  */
	static function qq()
	{
		return "<span class=\"ds-thread-count\" data-thread-key=\"".C('COOKIE_PREFIX').$GLOBALS['_fields']['id']."\" data-count-type=\"qqt_reposts\"></span>";
	}
	
	/*վ����������*/
	/*
		����1: short_name  ���� 
		����2: hotlist-range  �������·�Χ  0=ÿ��,1=ÿ��,2=ÿ��
		����3: hotlist-items  �������¸���  Ĭ��ֵ 5��
	*/
	static function hotlist()
	{
		$plugin = new Plugin();
		$config = $plugin->config();
		if(empty($config['hotlist-range']) or $config['hotlist-range']==0) $range = 'daily';
		if($config['hotlist-range']==1) $range = 'weekly';
		if($config['hotlist-range']==2) $range = 'monthly';
		$item = empty($config['hotlist-items']) ? 5:$config['hotlist-items'];
		$str =<<<DATA
		<ul  class="ds-top-threads" data-range="{$range}" data-num-items="{$item}"></ul><script type="text/javascript">var duoshuoQuery = {short_name:"{$config['short_name']}"};(function() {var ds = document.createElement('script');ds.type = 'text/javascript';ds.async = true;ds.src = 'http://static.duoshuo.com/embed.js';ds.charset = 'UTF-8';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds);})();</script>
DATA;
		return $str;
	}
	
	/*վ������ÿ�*/
	/*
		����1: short_name  ���� 
		����3: visitor-items  �ÿ�����  Ĭ��ֵ 5
	*/
	static function visitor()
	{
		$plugin = new Plugin();
		$config = $plugin->config();
		$item = empty($config['visitor-items']) ? 10:$config['visitor-items'];
		$str =<<<DATA
		<ul class="ds-recent-visitors" data-num-items="{$item}"></ul><script type="text/javascript">var duoshuoQuery = {short_name:"{$config['short_name']}"};(function() {var ds = document.createElement('script');ds.type = 'text/javascript';ds.async = true;ds.src = 'http://static.duoshuo.com/embed.js';ds.charset = 'UTF-8';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds);})();</script>
DATA;
		return $str;
	}
	
	/*վ����������*/
	/*
		����1: short_name  ���� 
		����2: newlist-items  	����������  Ĭ��ֵ 10��
		����3: newlist-show-avatars  �Ƿ���ʾͷ��1����ʾ��0������ʾ
		����4: newlist-show-time  �Ƿ���ʾʱ�䣬1����ʾ��0������ʾ
		����5: newlist-show-title  �Ƿ���ʾ���⣬1����ʾ��0������ʾ
		����6: newlist-show-admin  �Ƿ���ʾ����Ա�����ۣ�1����ʾ��0������ʾ
		����7: newlist-excerpt-length  �����ʾ���ۺ����� Ĭ�� 70
	*/
	static function newlist()
	{
		$plugin = new Plugin();
		$config = $plugin->config();
		$item = empty($config['newlist-items']) ? 10:$config['newlist-items'];
		$avatars = empty($config['show-avatars']) ? 1:$config['show-avatars'];
		$time = empty($config['show-time']) ? 1:$config['show-time'];
		$title = empty($config['show-title']) ? 1:$config['show-title'];
		$admin = empty($config['show-admin']) ? 1:$config['show-admin'];
		$length = empty($config['excerpt-length']) ? 1:$config['excerpt-length'];
		$str =<<<DATA
		<ul class="ds-recent-comments" data-num-items="{$item}" data-show-avatars="{$avatars}" data-show-time="{$time}" data-show-title="{$title}" data-show-admin="{$admin}" data-excerpt-length="{$length}"></ul><script type="text/javascript">var duoshuoQuery = {short_name:"{$config['short_name']}"};(function() {var ds = document.createElement('script');ds.type = 'text/javascript';ds.async = true;ds.src = 'http://static.duoshuo.com/embed.js';ds.charset = 'UTF-8';(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ds);})();</script>
DATA;
		return $str;
	}
	
}