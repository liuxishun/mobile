<?php
class IndexAction extends BaseAction{
	public function _initialize(){
        parent::_initialize();

    }
    
    public function index(){
		$this->display();
	}
	public function top(){
		$user = M("admin");
		$id = $_SESSION['admin_info']['user_id'];
		$p = $this->_getChannel();
	
			foreach($p as $k=>$v){
					$Channel[$k] = $v;
			}
		
		$this->assign('Channel',$Channel);
      	$this->display(); 
	}
	public function left(){ 
		$Menu = $this->_getMenu(); 
    	$this->assign('Menu',$Menu); 
    	$this->assign('status',$_GET['status']);
		$this->display();
	}
    public function drag(){ 
		$this->display();
	}
	public function right(){
		$security_info=array();
		if(APP_DEBUG==true){
			$security_info['温馨提示'] ="强烈建议您网站上线后，关闭 DEBUG （错误提示）";
		}
		$this->assign('security_info',$security_info);
		$server_info = array(
		    '信息平台版本'=>'1.0 beta',
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
		    'PHP运行方式'=>php_sapi_name(),
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            'Socket支持情况'=> 'fsockopen:' . (function_exists('fsockopen')? '<span style="color:green;">√</span>' : '×') . ' &nbsp; &nbsp;' .
                               'pfsockopen:' . (function_exists('pfsockopen')? '<span style="color:green;">√</span>' : '×') . ' &nbsp; &nbsp;' .
                               'stream_socket_client:' . (function_exists('stream_socket_client')? '<span style="color:green;">√</span>' : '×') . ' &nbsp; &nbsp;' .
                               'curl_init:' . (function_exists('curl_init')? '<span style="color:green;">√</span>' : '×') . ' &nbsp; &nbsp;',
		    '服务器时间'=>date("Y年n月j日 H:i:s"),
		    '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
		);
        $server_info = array_merge($server_info, $security_info);
		$this->assign('server_info', $server_info);
		$Depart_mod=D('Department');
		$res=$Depart_mod->where('id='.$_SESSION['admin_info']['depart_id'])->find();
		$this->assign('department',$res);
		$this->display();
	}
	
	public function _getChannel() {
    	$menu = $this->_getMenu(false);
        $rt = array();
        foreach($menu as $k=>$v){
            $k=explode('_', $k);
            $rt[$k[0]] = $k[1];
        }
        return $rt;
    }

    //如有参数，格式如：模块/action/参数名/参数值
    protected function _getMenu($fixkey=true) {
        $menu = array();
    	$menu['sys_系统管理'] 		=   array(
    		'站点文章管理'		=>  array(
 				'文章列表'	=> 'Siteinfo/lists',
    			'文章添加'	=> 'Siteinfo/add', 
                '分类列表'	=> 'Siteinfotype/lists',
    			'分类添加'	=> 'Siteinfotype/add', 
    		),
            '管理员管理'		=>  array(
 				'管理员列表'	=> 'Admin/lists',
    			'管理员添加'	=> 'Admin/add', 
    		),
			'权限管理'     	=> array(
				'权限组列表'	=> 'Rbac/roles',
                '添加权限组'	=> 'Rbac/role_add',
                '控制节点'	=> 'Rbac/nodes',
                '添加节点'	=> 'Rbac/node_add',
			),
            '配置管理'     	=> array(
				'系统配置'	=> 'Config/edit',
			),
			'通用菜单'		=> array( 
				'清空缓存' 	=> 'Index/cache',
                '修改密码' 	=> 'Admin/changepsw',
			),
    		'地区管理'		=>  array(
    					'地区列表'	=> 'Area/index',
    			),
		);
       

        $menu['houseworker_阿姨管理'] 		=   array(
    		'阿姨管理'		=>  array(
 				'阿姨列表'	=> 'Houseworker/lists',
                '阿姨添加'	=> 'Houseworker/add',
                //'评论添加'	=> 'Pinglun/add',
                '评论列表'	=> 'Pinglun/lists',
    		),
            '类别管理'		=>  array(
 				'类别列表'	=> 'Hwtype/lists',
                '类别添加'	=> 'Hwtype/add',
    		),
            '星级管理'		=>  array(
 				'星级列表'	=> 'Hwlevel/lists',
                '星级添加'	=> 'Hwlevel/add',
    		),
            '证书管理'		=>  array(
 				'证书列表'	=> 'Hwpaper/lists',
                '证书添加'	=> 'Hwpaper/add',
    		),
        		'标签管理'		=>  array(
        				'标签列表'	=> 'Houseworker/taglists',
        				'标签添加'	=> 'Houseworker/tagadd',
        		),
		);

        $menu['appointment_预约管理'] 		=   array(
    		'预约管理'		=>  array(
 				'预约列表'	=> 'Appointment/lists',
    		),
		);

        $menu['member_会员管理'] 		=   array(
    		'会员管理'		=>  array(
 				'会员列表'	=> 'Member/lists',
    		),
		);

        $menu['feedback_反馈管理'] 		=   array(
    		'反馈管理'		=>  array(
 				'反馈列表'	=> 'Feedback/index',
    		),
		);
        $menu['invest_健康管理'] 		=   array(
        		'健康测评表管理'		=>  array(
        				'测评表列表'	=> 'Invest/index',
        				'测评表添加'	=> 'Invest/add',
        				'测评表选项列表'	=> 'Invest/itemlist',
        				'测评表选项添加'	=> 'Invest/additem',
        		),
        		'健康档案管理'		=>  array(
        				'月子期健康档案列表'	=> 'Maternal/index',
        				'月子期健康档案添加'	=> 'Maternal/add',
        		),
        		'月嫂护理日志'		=>  array(
        				'信息档案管理'	=> 'Ruhuxinxi/index',
        				'信息档案表添加'	=> 'Ruhuxinxi/add',
        				'护理日志列表'	=> 'Nurselog/index',
        				'下户总结列表'	=> 'Xiahusummary/index',
        		),
        );
        $menu['peroid_健康信息'] 		=   array(
        		
        		'指标管理'		=>  array(
        				'添加指标'	=> 'Indicator/add',
        				'指标列表'	=> 'Indicator/index',
        				
        		),
        		'视频管理'		=>  array(
        				'添加视频'	=> 'Shipin/add',
        				'视频列表'	=> 'Shipin/index',
        		
        		),
        		'症状管理'		=>  array(
        				'添加症状'	=> 'Symptom/add',
        				'症状列表'	=> 'Symptom/index',
        				
        		),
        		'文章管理'		=>  array(
        				'文章列表'	=> 'Siteinfo/lists',
        				'文章添加'	=> 'Siteinfo/add',
        				'分类列表'	=> 'Siteinfotype/lists',
        				'分类添加'	=> 'Siteinfotype/add',
        		),
        		'胎教管理'		=>  array(
        				'胎教发布'	=> 'Music/add',
        				'胎教列表'	=> 'Music/index',
        		),
        		'食物管理'		=>  array(
        				'建议发布'	=> 'Suggest/add',
        				'建议列表'	=> 'Suggest/index',
        				'食物发布'	=> 'Foodsrecmend/add',
        				'食物列表'	=> 'Foodsrecmend/index',
        		),
        		
        );
        $menu['material_食材管理'] 		=   array(
        		'食物库管理'		=>  array(
        				'食物发布'	=> 'Foods/add',
        				'食物库列表'	=> 'Foods/index',
        		),
        		
        );
        $rt=array();
        import('ORG.Util.MyRBAC');
        foreach($menu as $ck=>$cv){
            if($fixkey)$ck=reset(explode('_', $ck));
            foreach($cv as $gk=>$gv){
                foreach($gv as $k=>$v){
                    if(MyRBAC::AccessDecision(null, $v, null)){
                        $rt[$ck][$gk][$k] = U($v);
                    }
                }
            }
        }
    	return $rt;
    }
    
    /**
     * 清空缓存
     */
	public function cache(){
		$adir=RUNTIME_PATH;
		$this->delFile($adir);

		$idir="./home/Runtime";
		$this->delFile($idir);

        $idir="./api/Runtime";
		$this->delFile($idir);

        $idir="./mobile/Runtime";
		$this->delFile($idir);


		$this->success("清除缓存成功", "__APP__/Index/right");
	}

}
?>