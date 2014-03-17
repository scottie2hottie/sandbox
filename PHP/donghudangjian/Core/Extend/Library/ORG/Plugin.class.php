<?php/***********************************************************    [WaiKuCms] (C)2011 - 2013 waikucms.com    	@function 插件基类    @Filename Plugin.class.php $    @Author pengyong $    @Date 2012-12-21 12:10:11 $*************************************************************/class  Plugin extends CommonAction{	//注册挂载点	protected function reg_tags($tid,$method)	{		$data['tid'] = $tid;		//pid 自动获取		$plugin = M('plugin');		$map['title'] = rtrim(__CLASS__,'Plugin');		$list = $plugin->field('id')->where($map)->find();		if(!$list) return;		$data['pid'] = $list['id'];		$data['method'] = $method;		$model = M('plugin_tags_reg');		$model->add($data);	}	//反注册挂载点	protected function unreg_tags()	{		$plugin = M('plugin');		$map['title'] = rtrim(__CLASS__,'Plugin');		$list = $plugin->field('id')->where($map)->find();		if(!$list) return;		$data['pid'] = $list['id'];		$model = M('plugin_tags_reg');		$model->where($data)->delete();	}	//改写display方法,渲染模板返回	protected function display($tpl='')	{		$path = C('__PLUGIN__').'/Tpl/';		$tplpath =  !empty($tpl) ? $path.$tpl:$path.'index.html'; 		//后缀检测		if(substr($tplpath,-1,5) <> '.html' && !strpos(strrchr($tplpath,'/'),'.')) $tplpath .='.html'; 		//绝对路径访问		if(substr($tpl,0,2)=='./') $tplpath = $tpl; 		//public:error 形式支持		if(strpos($tpl,':'))		{			$tpl = explode(':',$tpl);			$tplpath = TMPL_PATH.$tpl[0].'/'.$tpl[1].'.html';		}		if(!file_exists($tplpath)) return 'File:'.$tplpath.' not found!';				return $this->fetch($tplpath); 	}	//改写show方法,渲染内容返回	protected function show($content='')	{		return $this->fetch('',$content.' ');	}	    /**     * [改写后的]操作错误跳转的快捷方法     * @access protected     * @param string $message 错误信息     * @param string $jumpUrl 页面跳转地址     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间     * @return void     */    protected function error($message,$jumpUrl='',$ajax=false) {        return $this->PlugindispatchJump($message,0,$jumpUrl,$ajax);    }    /**     * [改写后的]操作成功跳转的快捷方法     * @access protected     * @param string $message 提示信息     * @param string $jumpUrl 页面跳转地址     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间     * @return void     */    protected function success($message,$jumpUrl='',$ajax=false) {        return $this->PlugindispatchJump($message,1,$jumpUrl,$ajax);    }		/**	 * 改写框架默认信息提示操作     * 默认跳转操作 支持错误导向和正确跳转     * 调用模板显示 默认为public目录下面的success页面     * 提示页面为可配置 支持模板标签     * @param string $message 提示信息     * @param Boolean $status 状态     * @param string $jumpUrl 页面跳转地址     * @param mixed $ajax 是否为Ajax方式 当数字时指定跳转时间     * @access private     * @return void     */    private function PlugindispatchJump($message,$status=1,$jumpUrl='',$ajax=false) {        if(true === $ajax || IS_AJAX) {// AJAX提交            $data           =   is_array($ajax)?$ajax:array();            $data['info']   =   $message;            $data['status'] =   $status;            $data['url']    =   $jumpUrl;            $this->ajaxReturn($data);        }        if(is_int($ajax)) $this->assign('waitSecond',$ajax);        if(!empty($jumpUrl)) $this->assign('jumpUrl',$jumpUrl);        // 提示标题        $this->assign('msgTitle',$status? L('_OPERATION_SUCCESS_') : L('_OPERATION_FAIL_'));        //如果设置了关闭窗口，则提示完毕后自动关闭窗口        if($this->get('closeWin'))    $this->assign('jumpUrl','javascript:window.close();');        $this->assign('status',$status);   // 状态        //保证输出不受静态缓存影响        C('HTML_CACHE_ON',false);        if($status) { //发送成功信息            $this->assign('message',$message);// 提示信息            // 成功操作后默认停留1秒            if(!$this->get('waitSecond'))    $this->assign('waitSecond','1');            // 默认操作成功自动返回操作前页面            if(!$this->get('jumpUrl')) $this->assign("jumpUrl",$_SERVER["HTTP_REFERER"]);            return $this->display(C('TMPL_ACTION_SUCCESS'));        }else{            $this->assign('error',$message);// 提示信息            //发生错误时候默认停留3秒            if(!$this->get('waitSecond'))    $this->assign('waitSecond','3');            // 默认发生错误的话自动返回上页            if(!$this->get('jumpUrl')) $this->assign('jumpUrl',"javascript:history.back(-1);");           return  $this->display(C('TMPL_ACTION_ERROR'));            // 中止执行  避免出错后继续执行           // exit ;        }    }		  /**     * [改写]Ajax方式返回数据到客户端     * @access protected     * @param mixed $data 要返回的数据     * @param String $type AJAX返回数据格式     * @return void     */    protected function ajaxReturn($data,$type='') {        if(func_num_args()>2) {// 兼容3.0之前用法            $args           =   func_get_args();            array_shift($args);            $info           =   array();            $info['data']   =   $data;            $info['info']   =   array_shift($args);            $info['status'] =   array_shift($args);            $data           =   $info;            $type           =   $args?array_shift($args):'';        }        if(empty($type)) $type  =   C('DEFAULT_AJAX_RETURN');        switch (strtoupper($type)){            case 'JSON' :                // 返回JSON数据格式到客户端 包含状态信息                header('Content-Type:application/json; charset=utf-8');                return json_encode($data);            case 'XML'  :                // 返回xml格式数据                header('Content-Type:text/xml; charset=utf-8');                return xml_encode($data);            case 'JSONP':                // 返回JSON数据格式到客户端 包含状态信息                header('Content-Type:application/json; charset=utf-8');                $handler  =   isset($_GET[C('VAR_JSONP_HANDLER')]) ? $_GET[C('VAR_JSONP_HANDLER')] : C('DEFAULT_JSONP_HANDLER');                return $handler.'('.json_encode($data).');';              case 'EVAL' :                // 返回可执行的js脚本                header('Content-Type:text/html; charset=utf-8');                return $data;                        default     :                // 用于扩展其他返回格式数据                tag('ajax_return',$data);        }    }		//读取插件配置	protected function config()	{		return F('plugin','',C('__PLUGIN__').'/');	}}