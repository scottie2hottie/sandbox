<?php
/***********************************************************
    [WaiKuCms] (C)2011 - 2013 waikucms.com
    
	@function Admin组 挂载点视图模型

    @Filename TagViewModel.class.php $

    @Author pengyong $

    @Date 2013-01-09 14:35:13 $
*************************************************************/
class PluginTagViewModel extends ViewModel {
   public $viewFields = array(
   'plugin_tags_reg'=>array('id','pid','tid','method','_type'=>'LEFT'), 
   'plugin_tags'=>array('group','class','action','tag','_on'=>'plugin_tags_reg.tid=plugin_tags.id','_type'=>'LEFT'), 
   'plugin'=>array('status','title','_on'=>'plugin_tags_reg.pid=plugin.id'), 
   );
   }