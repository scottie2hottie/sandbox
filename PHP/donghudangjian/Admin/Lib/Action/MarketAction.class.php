<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2013 waikucms.com
    
	@function Admin组 扩展市场

    @Filename PluginManageAction.class.php $

    @Author pengyong $

    @Date 2013-01-10 14:45:09 $
*************************************************************/
class MarketAction extends CommonAction
{	
	public function plugin()
	{
		header('Location:http://www.waikucms.com/market.php?type=plugin');
	}
	
	public function theme()
	{
		header('Location:http://www.waikucms.com/market.php?type=theme');
	}
}
?>