<?php
//手机app接口
class KeAction extends BaseAction {
	
    public function _initialize(){
        parent::_initialize();
        header("Access-Control-Allow-Origin: *");
    }
    
    //验证手机号码
    public function isMobile($mobile) {
    	if (!is_numeric($mobile)) {
    		return false;
    	}
    	return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $mobile) ? true : false;
    }
    
    public function index(){
    	$this->display();
    }
    
    //我的二维码
    public function pennants($name=0){
    	$openid = $this->_get('openid');
    	/*
    	$zi = M('weixin_tp','user_')->where("openid='{$openid}'")->find();
    	if(!$zi['name']){
    		if(mb_strlen($zi['nickname'],'utf-8') > 3){
    			$zi['name'] = mb_substr($zi['nickname'], 0, 3,'utf-8');
    		}else{
    			$zi['name'] = $zi['nickname'];
    		}
    	}
    	*/
    	//$text = '昵称字体';//昵称
    	$dst_path = 'Public/ban/pennants.jpg';//背景图
    	//创建图片的实例
    	$dst = imagecreatefromstring(file_get_contents($dst_path));
    	//打上文字
    	//$font = 'Public/ban/simsun.ttc';//字体
    	$font = 'Public/ban/Bold.ttc';//字体
    	$black = imagecolorallocate($dst, 251, 241, 0);//字体颜色金色
    	$x = 180;
    	foreach (preg_split('/(?<!^)(?!$)/u', $name ) as $c){
    		imagefttext($dst, 20, 0, 525, $x, $black, $font, $c);
    		$x += 25;
    	}
    	
    	//输出图片
    	list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
    	//$ul = "Public/ban/jiangz{$zi['id']}.jpg";
    	switch ($dst_type) {
    		case 1://GIF
    			header('Content-Type: image/gif');
    			imagegif($dst);
    			//imagegif($dst,$iname.'.gif');
    			break;
    		case 2://JPG
    			header('Content-Type: image/jpeg');
    			imagejpeg($dst);
    			//imagejpeg($dst,$iname.'.jpg');
    			break;
    		case 3://PNG
    			header('Content-Type: image/png');
    			imagepng($dst);
    			//imagepng($dst,$iname.'.png');
    			break;
    		default:
    			break;
    	}
    	imagedestroy($dst);
    }
    
    //支付页面
    public function upimg(){
    	$file = $_FILES['rili'];//得到传输的数据
    	if($file['name']){
    		//得到文件名称
    		$name = $file['name'];
    		//得到文件类型，并且都转化成小写
    		$type = strtolower(substr($name,strrpos($name,'.')+1));
    		//定义允许上传的类型
    		$allow_type = array('jpg','jpeg','gif','png');
    		//判断文件类型是否被允许上传,如果不被允许，则直接停止程序运行
    		if(!in_array($type, $allow_type)){
    			return ;
    		}
    		//判断是否是通过HTTP POST上传的,如果不是通过HTTP POST上传的
    		if(!is_uploaded_file($file['tmp_name'])){
    			return ;
    		}
    		//上传文件的存放路径
    		$path = "Public/ban/rili.png";
    		//开始移动文件到相应的文件夹
    		if(move_uploaded_file($file['tmp_name'],$path)){
    			
    		}
    		$this->ajaxReturn('11');
    		die;
    	}
    	if(!empty($_POST["jine"])){
    		$txt = str_replace('666',$_POST['jine'], file_get_contents("38zf/zf/yue00.php"));
    		$ul = '38zf/zf/yue'.$_POST['jine'].'.php';
    		$myfile = fopen($ul, "w") or die("Unable to open file!");
    		fwrite($myfile, $txt);
    		fclose($myfile);
    		$url='http://'.$_SERVER['SERVER_NAME'].'/'.$ul;
    		//$url = dirname($url).'/'.$ul;
    		$file = $_FILES['yueret'];//月嫂支付成功图片
    		if($file['name']){
    			//得到文件名称
    			$name = $file['name'];
    			//得到文件类型，并且都转化成小写
    			$type = strtolower(substr($name,strrpos($name,'.')+1));
    			//定义允许上传的类型
    			$allow_type = array('jpg','jpeg','gif','png');
    			//判断文件类型是否被允许上传,如果不被允许，则直接停止程序运行
    			if(!in_array($type, $allow_type)){
    				return ;
    			}
    			//判断是否是通过HTTP POST上传的,如果不是通过HTTP POST上传的
    			if(!is_uploaded_file($file['tmp_name'])){
    				return ;
    			}
    			//上传文件的存放路径
    			$path = "38zf/zf/images/{$_POST['jine']}.png";
    			//开始移动文件到相应的文件夹
    			if(move_uploaded_file($file['tmp_name'],$path)){
    				
    			}
    		}
    		$this->ajaxReturn($url);
    		die;
    	}
    	$this->display();
    }
    
    //获取用户
    public function user($openid){
    	$arr = M('weixin','user_')->where("openid='{$openid}'")->find();
    	if($arr){
    		$ho = M('houseworker')->where("mobile='{$arr['phone']}'")->find();
    		array_push($arr, $ho);
    	}
    	return $arr;
    }
    
    /**
     * 新直播页面列表
     */
    public function jy_zhibo(){
    	if(!isset($_GET['page'])){
    		$this->assign("openid", $_GET["openid"]);
    		$this->display();
    	}else {
    		$st = 20*$_GET['page'];
    		$list=M("video")->where("leibie='199直播' and is_stauts=1 and id <> 130")->order("is_top desc,id desc")->limit($st.',20')->select();
    		$str = '';
    		foreach ($list as $v){
    			$Stimes=date("Y-m-d H:i", strtotime($v["start_time"]));
    			$Etimes=date("H:i", strtotime($v["end_time"]));
    			$str .= "<li><a href='http://m.mumway.com/199zb/index.html?vid={$v['vid']}'>";
    			$str .="<img src='http://my.mumway.com/{$v['pic']}' onerror='javascript:this.src='/{$v['pic']}';'>";
    			$str .='<div class="live_d1">';
    			//$str .="<P class='live_p1'><span class='live_p1_s2'>专用直播间</span></P>";
    			//$str .="<P class='live_p2'><span>主题：</span>{$v['title']}</P>";
    			$str .="<P class='live_p3'><span class='live_p3_s1'>$Stimes-$Etimes</span></P>";
    			$str .="</div></a></li>";
    		}
    		$this->ajaxReturn($str);
    	}
    	
    }
    
    /**
     * 直播页面
     */
    public function jy_zhibo2(){
    	if(!$_GET['openid']){
    		header("Location: http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/jy_zhibo2");
    		die;
    	}
    	$st = 20*$_GET['page'];
    	$list = M("video")->where("(leibie='母婴' or leibie='育儿') and is_stauts=1")->order("is_top desc,id desc")->limit($st.',20')->select();
    	if($this->isAjax()){
    		$str = '';
    		foreach ($list as $v){
    			$str .= "<li><a href='/index.php/ke/zhibo1/openid/{$_GET['openid']}/id/{$v['id']}'>";
    			$str .="<img src='http://my.mumway.com/{$v['pic']}' onerror='javascript:this.src='/{$v['pic']}';'>";
    			$str .='<div class="live_d1">';
    			$str .="<P class='live_p1'><span class='live_p1_s1'>{$v['leibie']}</span><span class='live_p1_s2'>专用直播间</span></P>";
    			$str .="<P class='live_p2'><span>主题：</span>{$v['title']}</P>";
    			$now=time();
    			$Stime=strtotime($v["start_time"]);
    			$Etime=strtotime($v["end_time"]);
    			$Stimes=date("Y-m-d H:i",$Stime);
    			$Etimes=date("H:i",$Etime);
    			$str .="<P class='live_p3'><span class='live_p3_s1'>$Stimes-$Etimes</span>";
    			if($now>$Etime){
    				$str .='<span style="background-color:#ccc;" class="live_p3_s2">历史直播</span>';
    			}else{
    				$str .='<span class="live_p3_s2">加入直播</span>';
    			}
    			$str .="</P></div></a></li>";
    		}
    		$this->ajaxReturn($str);
    	}
    	$openid = $_GET["openid"];
    	$this->assign("openid", $openid);
    	$user = M('user_weixin',' ')->where("openid='{$openid}'")->find();
    	$user = M('user_weixin_lbq',' ')->where("unionid='{$user['unionid']}' and state=1")->find();
    	if($user){
    		$isShow = 1;
    	}else {
    		$isShow = 0;
    	}
    	$this->assign("isShow",$isShow);
    	$this->assign("list",$list);
    	$this->display();
    }
    
    /**
     * 直播播放页面
     */
    public function zhibo1(){
    	$id=$_GET["id"];
    	$_SESSION["openid"] = $_GET["openid"];
    	$this->assign("openid",$_GET["openid"]);
    	$shipin=M("video")->where("id=$id")->find();//id是唯一标识，只能查出唯一数据
    	$this->assign("shipin",$shipin);
    	//统计观看了多少人
    	$jisuanList=M("countzhibo")->where("openid='".$_SESSION["openid"]."' and urlid=$id")->find();
    	if($jisuanList){
    		$count_jisuan=M("countzhibo")->where("urlid=$id")->count();
    		$this->assign("jishuqi",$count_jisuan);
    	}else{
    		M("countzhibo")->add(array("openid"=>$_SESSION["openid"],"urlid"=>$id));
    		$count_jisuan=M("countzhibo")->where("urlid=$id")->count();
    		$this->assign("jishuqi",$count_jisuan);
    	}
    	//显示公告
    	$gglist=M("zhibogg","t_")->where("urlid=$id")->order("id desc")->find();
    	$this->assign("gglist",$gglist);
    	//显示观看人
    	$wlist = M('weixin','user_')->order('rand()')->limit('5')->select();
    	$this->assign("wlist",$wlist);
    	//查询是否可以观看
    	$where="openid='".$_SESSION["openid"]."' and KCID=".$shipin['id']." and STATE=1";
    	$row = M("dingdan"," ")->where($where)->find();
    	if($row){
    		$this->assign("playpay",1);
    	}else{
    		$this->assign("playpay",0);
    	}
    	$quan = M()->table("youhui y,youhui_us u")->field('y.jine as jine,y.id as quanid,u.id as qid')->where("u.openid ='{$_SESSION["openid"]}' and y.qtype=1 and y.fid=$id and u.shu > 0 and y.id=u.qid")->find();
    	if(!$quan){
    		//查看是否有优惠券
    		$quan = M()->table("youhui y,youhui_us u")->field('y.jine as jine,y.id as quanid,u.id as qid')->where("u.openid ='{$_SESSION["openid"]}' and y.qtype=1 and u.shu > 0 and y.id=u.qid")->find();
    	}
    	
    	$this->assign("quan",$quan);
    	$this->display();
    }
    
    //面授列表
    public function mianshou(){
    	if(!$_GET['openid']){
    		header("Location: http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/mianshou");
    		die;
    	}
    	$sc = M('shicao',' ')->select();
    	$list =  array();;
    	foreach ($sc as $v){
    		$arr = array();
    		if(strpos($v['SCPICS'], "|")){
    			$shanghu =  explode("|", $v['SCPICS']);
    			foreach ($shanghu as $k=>$vs) {
    				if($k == 3) break;
    				$arr[] = array('PIC'=>$vs);
    			}
    		}else {
    			if($v['SCPICS']) $arr[] = array('PIC'=>$v['SCPICS']);
    		}
    		$v['SCPICS'] = $arr;
    		$list[] = $v;
    	}
    	$this->assign('openid',$_GET['openid']);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //面授详情
    public function mianshou1(){
    	$db = M('shicao','user_');
    	if($this->isPost()){
    		$id = $_POST['SCID'];
    		$this->assign('openid',$_POST['openid']);
    		$user = $this->user($_POST['openid']);
    		$data['SCID'] = $_POST['SCID'];
    		$data['SCTIME'] = $_POST['SCTIME'];
    		$data['USERID'] = $_POST['openid'];
    		$sc = $db->where($data)->find();
    		if($sc){
    			$this->assign('display', 1);
    			$this->assign('text', '您已经报名！');
    		}else{
    			$data['USERNAME'] = $user['name'];
    			$data['USERPHONE'] = $user['phone'];
    			if(!$user['phone']){
    				$arr['openid'] = $_POST['openid'];
    				$arr['scid'] = $_POST['SCID'];
    				$this->assign('arr',$arr);
    				$this->display('mianshouuser');
    				exit;
    			}
    			if($db->add($data)){
    				$this->assign('display', 1);
    				$this->assign('text', '您已报名成功！');
    			}else{
    				$this->assign('display', 1);
    				$this->assign('text', '提交失败！');
    			}
    		}
    		
    	}else{
    		$id = $_GET['id'];
    		$this->assign('openid',$_GET['openid']);
    	}
    	
    	$sc = M('shicao',' ')->where("SCID='{$id}'")->find();
    	if(strpos($sc['SCPICS'], "|")){
    		$shanghu =  explode("|", $sc['SCPICS']);
    		$sc['SCPICS'] = $shanghu[0];
    	}
    	$sc['SCDETAIL'] = nl2br($sc['SCDETAIL']);//换行符转换为html br标签
    	$this->assign('arr',$sc);
    	$this->display();
    }
    
    //面授报名
    public function mianshouuser(){
    	$db = M('weixin','user_');
    	if($this->isPost()){
    		$data['phone'] = $_POST['phone'];
    		$data['name'] = $_POST['name'];
    		$db->where("openid='{$_POST['openid']}'")->save($data);
    		$arr = $db->where("openid='{$_POST['openid']}'")->find();
    		$this->assign('arr',$arr);
    		$ar['id'] = $_POST['scid'];
    		$ar['openid'] = $_POST['openid'];
    		$ar['ht'] = '1';
    		$this->redirect('ke/mianshou1',$ar);
    	}else{
    		$arr = $db->where("openid='{$_GET['openid']}'")->find();
    		$this->assign('arr',$arr);
    		$this->display();
    	}
    	 
    }
    
    //显示地图
    public function didian(){
    	$this->assign('openid',$_GET['openid']);
    	$this->assign('arr',$_GET);
    	$this->display();
    }

    //取证课程
    public function quzhengn(){
    	$list = M('class','super_')->where("TYPE=1")->select();
    	$this->assign('openid',$_GET["openid"]);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //取证课详情
    public function quzhengn1(){
    	$class = M('class','super_');
    	$video = M('video',' ');
    	$openid = $_GET["openid"];
    	$classid = $_GET["CLASS_ID"];
    	$this->assign('USER_ID',$openid);
    	$this->assign('USER',1);//判断是否登录
    	$cla = $class->where("CLASS_ID='{$classid}'")->find();
    	if($cla){
    		
    		$cla["openid"] = $openid;
    		//"VIDEO_ID"="01a2a8545aed4e709e61458ec55e9506");//查询视频
    		//判断是否手动点击播放
    		$vd = $video->where("VIDEO_ID='{$_GET["VIDEO_ID"]}'")->find();
    		if($vd){
    			$cla["VIDEOS"] = $vd["VIDEO"];
    			$cla["VIDEOSID"] = $vd["VIDEO_ID"];
    		}
    		$usid = '';
    		//是否购买
    		$user_class = M('class','user_');
    		$UC = $user_class->where("USER_ID='{$openid}' and CLASS_ID='{$classid}'")->find();
    		$cla["BOUGHT"] = 0;
    		if($UC){
    			$cla["BOUGHT"] = 1;
    		}else{
    			$wx = M('weixin','user_')->where("openid='{$openid}'")->find();
    			if($wx["phone"]){
    				$wx = M('houseworker')->where("mobile={$wx["phone"]}")->find();
    				if($wx){
    					$usid = $wx['id'];
    					$UC = $user_class->where("USER_ID='{$usid}' and CLASS_ID='{$classid}'")->find();
    					if($UC){
    						$cla["BOUGHT"] = 1;
    					}
    				}
    			}
    		}
    		
    		//收藏
    		$SC = M('sc','class_')->where("USERID='{$openid}' and CLASSID='{$classid}'")->find();
    		$cla["SAVE"] = 0;
    		if($SC){
    			$cla["SAVE"] = 1;
    		}else{
    			$SC = M('sc','class_')->where("USERID='{$usid}' and CLASSID='{$classid}'")->find();
    			if($SC){
    				$cla["SAVE"] = 1;
    			}
    		}
    		
    		$subclassList = M('class','sub_')->where("CLASS_ID='{$classid}'")->order('TITLE')->select();
    		$classList = array();
    		foreach ($subclassList as $v){
    			//视频
    			$videoList = M('video',' ')->where("SUBCLASS_ID='{$v['SUBCLASS_ID']}'")->order('PERIOD_NAME')->select();
    			if(!$cla["VIDEOS"]){
    				if($videoList){
    					$cla["VIDEOS"] = $videoList[0]["VIDEO"];
    					$cla["VIDEOSID"] = $videoList[0]["VIDEO_ID"];
    					//dump($cla);die;
    				}
    			}
    			$v["VIDEO"] = $videoList;
    			$classList[] = $v;
    		}
    		$cla['classList'] = $classList;
    		$cla['wlist'] = M('weixin','user_')->order('rand()')->limit('5')->select();
    	}
    	$this->assign('pd',$cla);
    	$this->display();
    }
    
    //微信取证课程
    public function quzheng(){
    	if(!$_GET['openid']){
    		header("Location: http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/quzheng");
    		die;
    	}
    	$list = M('superclass')->where("type='取证课程'")->select();
    	$this->assign('openid',$_GET["openid"]);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //微信取证课详情
    public function quzheng1(){
    	$openid = $_GET["openid"];
    	$classid = $_GET["id"];
    	$this->assign('openid',$openid);
    	//课程
    	$cla = M('superclass')->where("id={$classid}")->find();
    	if($cla){
    		//是否购买
    		$UC = M('classuser')->where("userid='{$openid}' and classid={$classid}")->find();
    		$cla["BOUGHT"] = 0;
    		if($UC){
    			$cla["BOUGHT"] = 1;
    		}else{
    			$user = $this->user($openid);
    			if($user[0]){
    				$UC = M('classuser')->where("userid={$user[0]['id']} and classid={$classid}")->find();
	    			if($UC){
		    			$cla["BOUGHT"] = 1;
		    		}
    			}
    		}
    		//根据点击视频查询
    		$vd = M('video')->where("id={$_GET["vid"]}")->find();
    		if($vd){
    			$cla["vurl"] = $vd["url"];
    			$cla["vid"] = $vd["id"];
    			//$cla["pic"] = $vd["pic"];
    		}
    		//章节
    		$subclassList = M('subclass')->where("subid='{$classid}'")->order('sort')->select();
    		$classList = array();
    		foreach ($subclassList as $v){
    			//视频
    			$videoList = M()->table('t_subvoclass s,t_video v')->where("s.subid={$v['id']} and s.videoid=v.id")->order('-s.sort desc')->select();
    			if(!$cla["vurl"]){
    				if($videoList){//默认播放第一节视频
    					$cla["vurl"] = $videoList[0]["url"];
    					$cla["vid"] = $videoList[0]["id"];
    				}
    			}
    			$v["video"] = $videoList;
    			$classList[] = $v;
    		}
    		$cla['classList'] = $classList;
    		//随机获取5名学员
    		$cla['wlist'] = M('weixin','user_')->order('rand()')->limit('5')->select();
    	}
    	 
    	$this->assign('pd',$cla);
    	$this->display();
    }
    
    //微信进修课程
    public function jinxiu(){
    	if(!$_GET['openid']){
    		header("Location: http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/jinxiu");
    		die;
    	}
    	$this->assign('openid',$_GET["openid"]);
    	/*
    	$list = M('superclass')->where("type='进修课程'")->order('jine')->select();
    	$this->assign('list',$list);
    	*/
    	$this->display('cika');
    }
    
    //微信进修课详情
    public function jinxiu1(){
    	$openid = $_GET["openid"];
    	$classid = $_GET["id"];
    	$this->assign('openid',$openid);
    	$cla = M('superclass')->where("id={$classid}")->find();
    	if($cla){
    		//判断是否手动点击播放
    		$vd = M('video')->where("id={$_GET["vid"]}")->find();
    		if($vd){
    			$cla["vurl"] = $vd["url"];
    			$cla["vid"] = $vd["id"];
    			//$cla["pic"] = $vd["pic"];
    		}
    		
    		//是否购买
    		$UC = M('classuser')->where("userid='{$openid}' and classid={$classid}")->find();
    		$cla["BOUGHT"] = 0;
    		if($UC){
    			$cla["BOUGHT"] = 1;
    		}else{
    			$user = $this->user($openid);
    			if($user[0]){
    				$UC = M('classuser')->where("userid={$user[0]['id']} and classid={$classid}")->find();
    				if($UC){
    					$cla["BOUGHT"] = 1;
    				}
    			}
    		}
    		$subclassList = M('subclass')->where("subid='{$classid}'")->order('sort')->select();
    		$classList = array();
    		foreach ($subclassList as $v){
    			//视频
    			$videoList = M()->table('t_subvoclass s,t_video v')->where("s.subid={$v['id']} and s.videoid=v.id")->order('-s.sort desc')->select();
    			if(!$cla["vurl"]){
    				if($videoList){
    					$cla["vurl"] = $videoList[0]["url"];
    					$cla["vid"] = $videoList[0]["id"];
    				}
    			}
    			$v["video"] = $videoList;
    			$classList[] = $v;
    		}
    		$cla['classList'] = $classList;
    		$cla['wlist'] = M('weixin','user_')->order('rand()')->limit('5')->select();
    	}
    
    	$this->assign('pd',$cla);
    	$this->display();
    }
    
    //进修课程
    public function jinxiun(){
    	$list = M('class','super_')->where("TYPE=2")->order('TITLE desc')->select();
    	$this->assign('openid',$_GET["openid"]);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //进修课详情
    public function jinxiun1(){
    	$class = M('class','super_');
    	$video = M('video',' ');
    	$openid = $_GET["openid"];
    	$classid = $_GET["CLASS_ID"];
    	$this->assign('USER_ID',$openid);
    	$this->assign('USER',1);//判断是否登录
    	$cla = $class->where("CLASS_ID='{$classid}'")->find();
    	if($cla){
    		$jine = $cla['PRICE'];
    		if(strpos($jine, '元')){
    			$jine = explode("元", $jine);
    			$cla['jine'] = $jine[0]+300;
    		}
    		$cla["openid"] = $openid;
    		//"VIDEO_ID"="01a2a8545aed4e709e61458ec55e9506");//查询视频
    		//判断是否手动点击播放
    		$vd = $video->where("VIDEO_ID='{$_GET["VIDEO_ID"]}'")->find();
    		if($vd){
    			$cla["VIDEOS"] = $vd["VIDEO"];
    			$cla["VIDEOSID"] = $vd["VIDEO_ID"];
    		}
    		$usid = '';
    		//是否购买
    		$user_class = M('class','user_');
    		$UC = $user_class->where("USER_ID='{$openid}' and CLASS_ID='{$classid}'")->find();
    		$cla["BOUGHT"] = 0;
    		if($UC){
    			$cla["BOUGHT"] = 1;
    		}else{
    			$wx = M('weixin','user_')->where("openid='{$openid}'")->find();
    			if($wx["phone"]){
    				$wx = M('houseworker')->where("mobile={$wx["phone"]}")->find();
    				if($wx){
    					$usid = $wx['id'];
    					$UC = $user_class->where("USER_ID='{$usid}' and CLASS_ID='{$classid}'")->find();
    					if($UC){
    						$cla["BOUGHT"] = 1;
    					}
    				}
    			}
    		}
    
    		//收藏
    		$SC = M('sc','class_')->where("USERID='{$openid}' and CLASSID='{$classid}'")->find();
    		$cla["SAVE"] = 0;
    		if($SC){
    			$cla["SAVE"] = 1;
    		}else{
    			$SC = M('sc','class_')->where("USERID='{$usid}' and CLASSID='{$classid}'")->find();
    			if($SC){
    				$cla["SAVE"] = 1;
    			}
    		}
    
    		$subclassList = M('class','sub_')->where("CLASS_ID='{$classid}'")->order('TITLE')->select();
    		$classList = array();
    		foreach ($subclassList as $v){
    			//视频
    			$videoList = M('video',' ')->where("SUBCLASS_ID='{$v['SUBCLASS_ID']}'")->order('PERIOD_NAME')->select();
    			if(!$cla["VIDEOS"]){
    				if($videoList){
    					$cla["VIDEOS"] = $videoList[0]["VIDEO"];
    					$cla["VIDEOSID"] = $videoList[0]["VIDEO_ID"];
    				}
    			}
    			$v["VIDEO"] = $videoList;
    			$classList[] = $v;
    		}
    		$cla['classList'] = $classList;
    		
    		$cla['wlist'] = M('weixin','user_')->order('rand()')->limit('5')->select();
    	}
    	 
    	$this->assign('pd',$cla);
    	$this->display();
    }
    
    //技能课程
    public function jineng(){
    	$list = array();
    	$tims = date("Y-m-d h:i:s", time());
    	$lists = M('zhibourl')->where("is_stauts=0 and start_time <'$tims'")->order('id desc')->select();
    	foreach ($lists as $v){
    		$vi['VIDEO_ID'] = $v['id'];
    		$vi['IMAGE'] = 'http://m.mumway.com/'.$v['pic'];
    		$vi['TITLE'] = $v['title'];
    		$vi['NAME'] = $v['name'];
    		array_push($list, $vi);
    	}
    	$lis = M('video',' ')->where("MIANFEI=2")->select();//免费
    	$db = M('class','sub_');
    	foreach ($lis as $v){
    		$vi['VIDEO_ID'] = $v['VIDEO_ID'];
    		$vi['TITLE'] = $v['PERIOD_NAME'];
    		//$vi['IMAGE'] = $v['IMAGE'];
    		$vi['NAME'] = "";
    		$tt = $db->where("SUBCLASS_ID='{$v['SUBCLASS_ID']}'")->find();
    		if($tt){
    			$vi['NAME'] = $tt['TEACHER'];
    			$vi['IMAGE'] ='http://my.mumway.com/'.$tt['IMAGE'];
    		}
    		array_push($list, $vi);
    	}
    	$this->assign('openid',$_GET["openid"]);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //技能课详情
    public function jineng1(){
    	$cla = M('video',' ')->where("VIDEO_ID='{$_GET["VIDEO_ID"]}'")->find();
    	if ($cla){
    		$cla['urlid'] = $cla['VIDEO_ID'];
    		$cla['bol'] = 1;
    		$cla['openid'] = $_GET["openid"];
    		$cla['jian'] = $cla["NAME"];//简介
    	}else{
    		$v = M('zhibourl')->where("id='{$_GET["VIDEO_ID"]}'")->find();//直播
    		$cla['IMAGE'] = 'http://m.mumway.com/'.$v['pic'];
    		$cla['TITLE'] = $v['title'];
    		$cla['NAME'] = $v['name'];
    		$cla['TEACHER'] = $v['name'];
    		$cla['NUMBER_LEARNED'] = 326;
    		$cla['url'] = $v['url'];
    		$cla['urlid'] = $v['id'];
    		$cla['bol'] = 0;
    		$cla['openid'] = $_GET["openid"];
    		$cla['jian'] = $v["jian"];//简介
    		//$cla['plist'] = M()->table('t_zhibopinglun t,user_weixin u')->where('t.openid=u.openid and t.urlid='.$_GET["VIDEO_ID"])->select();
    	}
    	$this->assign('pd',$cla);
    	$this->display();
    }
    
    //支付
    public function zhifu(){
    	$openid = $_GET["openid"];
    	$qid = $_GET["qid"];
    	$class = M('class','super_');
    	//购买章节
		if($_GET["SUBCLASS_ID"]){
			//课程
			$pd = M('class','sub_')->where("SUBCLASS_ID='{$_GET["SUBCLASS_ID"]}'")->find();
			if($pd){
				$pd["id"] = $_GET["SUBCLASS_ID"];
				$pd["zhi"] = "sub";//用于支付判断是套餐还是章节，此值是章节
				$pd["ul"] = "SUBCLASS_ID";
				//查看是否带中文“元”
				if(strpos($pd['PRICE'], '元')){
					$pr = explode('元',$pd['PRICE']);
					$pd['PRICE'] = $pr[0];
				}
				$pd["jine"] = $pd['PRICE'];
				$pd["pic"] = $pd['IMAGE'];
				$pd["title"] = $pd['TITLE'];
			}
		}
		//购买套餐
		if($_GET["CLASS_ID"]){
			//套餐
			$pd = M('class','super_')->where("CLASS_ID='{$_GET["CLASS_ID"]}'")->find();
			if($pd){
				$pd["id"] = $_GET["CLASS_ID"];
				$pd["zhi"] = "super";//用于支付判断是套餐还是章节，此值是套餐
				$pd["ul"] = "CLASS_ID";
				//查看是否带中文“元”
				if(strpos($pd['PRICE'], '元')){
					$pr = explode('元',$pd['PRICE']);
					$pd['PRICE'] = $pr[0];
				}
				$pd["jine"] = $pd['PRICE'];
				$pd["pic"] = $pd['IMAGE'];
				$pd["title"] = $pd['TITLE'];
			}
		}
		//购买微信套餐
		if($_GET["classid"]){
			//套餐
			$pd = M('superclass')->where("id={$_GET["classid"]}")->find();
			if($pd){
				$pd["id"] = $_GET["classid"];
				$pd["zhi"] = "wxsuper";//用于支付判断是套餐还是章节，此值是套餐
				$pd["ul"] = "classid";
				//$pd["jine"] = 0.01;
			}
		}
		
		if($pd){
			$pd["quanid"] = 0;//券主键
			$pd["quane"] = 0;//券金额
			$pd["qjine"] = $pd["jine"];
			//判断是否有优惠券
			if($qid){
				$quan = M('youhui',' ')->where("id=$qid")->find();;
				if($quan){
					$pd["quanid"] =  $quan["id"];//券主键
					$pd["quane"] =  $quan["jine"];//券金额
					$pd["jine"] = $pd["jine"]-$quan["jine"];//券金额
				}
			}
		}
		$this->assign('openid',$openid);
    	$this->assign('pd',$pd);
    	$this->display();
    }
    
    //支付券
    public function quan_list(){
    	$openid = $_GET['openid'];
    	$tab = 'youhui yh, youhui_us us';
    	//qtype=0是课程券
    	$wr = " yh.qtype = 0 and us.openid = '{$openid}' and yh.fid in (0,{$_GET['kcid']}) and us.shu > 0 and yh.id = us.qid";
    	$list = M()->table($tab)->field('yh.*')->where($wr)->select();
    	$this->assign('pd',$_GET);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //我的优惠券
    public function wodequan(){
    	$openid = $_GET['openid'];
    	if(!$openid) $openid = 'null';
    	$tab = 'youhui yh, youhui_us us';
    	$wr = "us.shu > 0 and us.openid = '{$openid}' and yh.id = us.qid ";
    	$list = M()->table($tab)->field('yh.*,us.shu')->where($wr)->select();
    	$this->assign('pd',$_GET);
    	$this->assign('list',$list);
    	$this->display('quan_list');
    }
    
    //支付添加订单
    public function dingdan(){
    	$_POST['ADDTIME'] = date("Y-m-d h:i:s", time());
    	$_POST['ORDERID'] = 'ke'.date("Ymdhis", time());
    	$ret['tp'] = 1;
    	if($_POST['MONEY'] == 0){
    		$uc['userid'] = $_POST['USERID'];
    		$uc['classid'] = $_POST['KCID'];
    		$uc['addtime'] = $_POST['ADDTIME'];
    		M('classuser')->add($uc);
    		$ret['tp'] = 2;
    		$_POST['STATE'] = 1;
    	}
    	$where["USERID"] = $_POST['USERID'];
    	$where["KCID"] = $_POST['KCID'];
    	$where["ADDTIME"] = array('gt',date("Y-m-d", time()));
    	$where["STATE"] = 0;
    	$where["MONEY"] = $_POST['MONEY'];
    	$row = M('dingdan', ' ')->where($where)->find();
    	if($row){
    		$id = $row["ID"];
    	}else{
    		$id = M('dingdan', ' ')->add($_POST);//添加订单
    	}
    	$ret['id'] = $id;
    	echo json_encode($ret);
		die;
    }
    
    //直播订单
    public function zbdingdan(){
    	$token = $this->_post('token');
    	$db = M()->table('dingdan');
    	$data['openid'] = $this->_post('token');//用户openid
    	$data['USERID'] = 0;//用户id
    	$data['KCID'] = $this->_post('kcid');//课程主键
    	$data['MONEY'] = $this->_post('money');//金额
    	$data['PAYCONTENT'] = $this->_post('paycontent');//付费项目名称
    	$data['ORDERID'] = 'zb'.time();
    	$data['PAYCHANNEL'] = 'wx';
    	if($_POST['quanid']){
    		$data['QUANID'] = $_POST['quanid'];
    		$data['QUANE'] = $_POST['quane'];
    	}else{
    		$data['QUANID'] = 0;
    		$data['QUANE'] = 0;
    	}
    	$data['PINGID'] = 0;
    	$data['ADDTIME'] = date('Y-m-d H:i:s',time());
    	//用于判断是否需要支付
    	if($_POST["money"] == 0){
    		$data['STATE'] = 1;
    		$row = M()->table('dingdan')->add($data);
    		if($row){
    			$rt['success'] = 1;
    			M()->execute("update youhui_us set shu = shu-1 where id = {$_POST['qid']}");
    			echo json_encode((object)$rt);
    		}else{
    			$rt['success'] = 0;
    			echo json_encode((object)$rt);
    		}
    		exit;
    	}else{
    		//修改优惠券的状态在支付成功回调函数里修改
    		$data['STATE'] =0;
    		$row = M()->table('dingdan')->add($data);
    		if($row) {
    			$rt['success'] = 100;
    			$rt['did'] = $row;
    		}else{
    			$rt['success'] = 101;
    		}
    		echo json_encode((object)$rt);
    		exit;
    	}
    
    }
    
    //显示公告
    public function ggajax(){
    	$id = $_POST['id'];
    	$gglist=M("zhibogg","t_")->where("urlid=$id")->order("id desc")->find();
    	echo $gglist["gonggao"];
    }
    
    //我的
    public function wode(){
    	if(!$_GET['openid']){
    		header("Location: http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/wode");
    		die;
    	}
    	$arr = M('weixin','user_')->where("openid='{$_GET['openid']}'")->find();
    	$this->assign('arr',$arr);
    	$this->assign('openid',$_GET['openid']);
    	$this->display();
    }
    
    //我的学习
    public function wodexuexi(){
    	$openid = $_GET['openid'];
    	$list = M('superclass')->join()->where("")->select();
    	$tab = 't_superclass cl, t_classuser us';
    	$where = "cl.id = us.classid and us.userid = '{$openid}' and cl.type='取证课程'";
    	$list = M()->table($tab)->field('cl.*,us.addtime as utime')->where($where)->select();
    	$this->assign('list',$list);
    	$this->assign('openid',$openid);
    	$this->display();
    }

    //我的学习
    public function wodexuexi_old(){
    	$openid = $_GET['openid'];
    	$user = $this->user($openid);
    	
    	$tab = 'sub_class cl, user_class us';
    	$wr = "cl.SUBCLASS_ID = us.SUBCLASS_ID and us.USER_ID = '{$openid}'";
    	$list = M()->table($tab)->field('cl.*,us.CREATE_TIME')->where($wr)->select();
    	
    	$tab = 'super_class cl, user_class us';
    	$wr = "cl.CLASS_ID = us.CLASS_ID and us.USER_ID = '{$openid}'";
    	$lists = M()->table($tab)->field('cl.*,us.CREATE_TIME')->where($wr)->select();
    	$list = array_merge($list,$lists);
    	if($user[0]){
    		$tab = 'sub_class cl, user_class us';
    		$wr = "cl.SUBCLASS_ID = us.SUBCLASS_ID and us.USER_ID = '{$user[0]['id']}'";
    		$lists = M()->table($tab)->field('cl.*,us.CREATE_TIME')->where($wr)->select();
    		$list = array_merge($list,$lists);
    		$tab = 'super_class cl, user_class us';
    		$wr = "cl.CLASS_ID = us.CLASS_ID and us.USER_ID = '{$user[0]['id']}'";
    		$lists = M()->table($tab)->field('cl.*,us.CREATE_TIME')->where($wr)->select();
    		$list = array_merge($list,$lists);
    	}
    	$this->assign('list',$list);
    	$this->assign('openid',$openid);
    	$this->display();
    }
    
    //我的直播
    public function wodezhibo(){
    	$openid = $_GET['openid'];
    	$user = $this->user($openid);
    	$tab = 'sub_class cl, user_class us';
    	$wr = "cl.SUBCLASS_ID = us.SUBCLASS_ID and us.USER_ID = '{$openid}'";
    	$list = M()->table($tab)->field('cl.*,us.CREATE_TIME')->where($wr)->select();
    	 
    	$tab = 'super_class cl, user_class us';
    	$wr = "cl.CLASS_ID = us.CLASS_ID and us.USER_ID = '{$openid}'";
    	$lists = M()->table($tab)->field('cl.*')->where($wr)->select();
    	$list = array_merge($list,$lists);
    	if($user[0]){
    		$tab = 'sub_class cl, user_class us';
    		$wr = "cl.SUBCLASS_ID = us.SUBCLASS_ID and us.USER_ID = '{$user[0]['id']}'";
    		$lists = M()->table($tab)->field('cl.*,us.CREATE_TIME')->where($wr)->select();
    		$list = array_merge($list,$lists);
    		$tab = 'super_class cl, user_class us';
    		$wr = "cl.CLASS_ID = us.CLASS_ID and us.USER_ID = '{$user[0]['id']}'";
    		$lists = M()->table($tab)->field('cl.*')->where($wr)->select();
    		$list = array_merge($list,$lists);
    	}
    	$this->assign('list',$list);
    	$this->assign('openid',$openid);
    	$this->display();
    }
    
    //绑定手机
    public function banguser(){
    	if(!$_GET['openid']){
    		header("Location: http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/banguser");
    		die;
    	}
    	$db = M('weixin','user_');
    	if($this->isPost()){
    		$openid = $_POST['openid'];
    		$arr = $db->where("openid='{$openid}'")->find();
    		/*
    		//判断是否是第一次绑定手机号码，是就添加一张9.9直播券
    		if(!$this->isMobile($arr['phone']) && $arr['qsta'] == 0){
    			$yhdb = M('youhui_us',' ');
    			$quan['openid'] = $openid;
    			$quan['qid'] = 4;
    			$yh = $yhdb->where($quan)->find();
    			if($yh){
    				$yhdb->where($quan)->setField('shu',$yh['shu']+1);
    			}else{
    				$quan['shu'] = 1;
    				$quan['addtime'] = date('Y-m-d H:i:s', time());
    				$yhdb->add($quan);
    			}
    			$arr['qsta'] = 1;//更改领券状态
    		}
    		*/
    		if($arr){
    			$arr['phone'] = $_POST['phone'];
    			$arr['name'] = $_POST['name'];
    			$db->where("openid='{$openid}'")->save($arr);
    		}else{
    			$arr['phone'] = $_POST['phone'];
    			$arr['name'] = $_POST['name'];
    			$arr['openid'] = $openid;
    			$db->add($arr);
    		}
    		$this->assign('openid',$openid);
    		$this->assign('arr',$arr);
    		$this->display('wode');
    	}else{
    		$arr = $db->where("openid='{$_GET['openid']}'")->find();
    		$this->assign('openid', $_GET['openid']);
    		$this->assign('arr',$arr);
    		$this->display();
    	}
    }
    
    //反馈
    public function fankui(){
    	if($this->isPost()){
    		$arr = M('weixin','user_')->where("openid='{$_POST['openid']}'")->find();
    		if($arr && $_POST['content']){
    			$data['token'] = $_POST['openid'];
    			$data['content'] = $_POST['content'];
    			$data['name'] = $arr['name'];
    			$data['phone'] = $arr['phone'];
    			$data['addtime'] = date("Y-m-d h:i:s", time());
    			M('fankui',' ')->add($data);
    		}
    		$this->assign('arr',$arr);
    		$this->assign('openid', $_POST['openid']);
    		$this->display('wode');
    	}else{
    		if(!$_GET['openid']){
    			header("Location: http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/fankui");
    			die;
    		}
    		$this->assign('openid', $_GET['openid']);
    		$this->display();
    	}
    	 
    }
    
    //查询视频
    public function getVideo(){
    	$vid = $this->_param("vid");
    	$openid = $this->_param("openid");
    	$db = M('video');
    	$row = $db->where(array("vid"=>$vid))->find();
    	if(!$row){
    		//$row = $db->where("leibie='199直播'")->order('id desc')->find();
    		$this->ajaxReturn(array("code"=>0,"msg"=>""));
    	}
    	$db->where('id='.$row['id'])->setInc("jishuqi");//自增1
    	$uv_db = M('video_uv');
    	if (!$uv_db->where("vid={$row['id']} and openid='{$openid}'")->find()){
    		$uv_db->add(array("vid"=>$row['id'], "openid"=>$openid));
    		$db->where('id='.$row['id'])->setInc("uv");//自增1
    	}
    	//推荐199套餐
    	$course = M('newadmin.mumway_herlive_course',' ')->where("id=".$row['herlive_course_id'])->find();
    	$course['content'] = nl2br($course['content']);
    	$row['course'] = $course;
    	/*是否显示红包
    	$share = M('newadmin.mumway_herlive_share',' ')->where("openid='{$openid}' and vid=".$row['id'])->find();
    	if($share){
    		$row['isshare'] = 1;
    	}
    	*/
    	/*是否答题
    	$integral = M('newadmin.mumway_herlive_integral',' ')->where("openid='{$openid}'")->find();
    	if(!$integral){
    		$row['ista'] = true;
    	}
    	*/
    	$this->ajaxReturn($row);
    }
    
    //添加评论
    public function pinglun(){
    	$data = $_POST;
    	$data['time'] = date("Y-m-d H:i:s",time());
    	$id = M('zhibopinglun')->add($data);
    	echo $id;
    	exit;
    }
    
    //查询评论
    public function getComments(){
    	//$list = M()->table('t_zhibopinglun t,user_weixin u')
    	$list = M()->table('t_zhibopinglun t,newadmin.mumway_herlive_wechat u')
    		->field('t.id,t.contents,t.time,t.reply,u.openid,u.nickname,u.headimgurl')
    		->where("t.openid=u.openid and t.urlid=%d and t.id > %d", $_GET['urlid'], $_GET['id'])
    		->order('t.id desc')
    		->select();
    	if(!$list){
    		$list = array();
    	}
    	$this->ajaxReturn($list);
    }
    
    //查询评论
    public function getpinglun(){
    	$openid = $_GET['openid'];
    	$list = M()->table('t_zhibopinglun t,user_weixin u')->where("t.openid=u.openid and t.urlid='{$_GET['urlid']}'")->order('t.id desc')->select();
    	$ret = "";
    	$ke = array('11','olwOsjqivi6kvZUQ1iR1t7Yk-3so');//客服人员olwOsjrxrNSFTMaImLq_qxpCHlqw崔
    	foreach ($list as $v){
    		//preg_match('/\d+/',$v['nickname'],$arr);
    		$name =  preg_replace('/\d+/', ' ', $v['nickname']);//去除名字中数字
    		if(in_array($v['openid'], $ke)){//客服
    			$ret .= "<li class='li1'>
    			<img src='{$v['headimgurl']}'>
    			<div class='broadcast_ul_d1'>
    			<P class='broadcast_ul_d1_p1'><span class='broadcast_ul_d1_p1_s1'>了不起小秘书</span><span class='broadcast_ul_d1_p1_s2'>{$v['time']}</span></P>
    			<div class='qp'>
    			<img class='qp_img' src='/Public/ke/img/qp3.png'>
    			<P class='broadcast_ul_d1_p2'>{$v['contents']}</P>
    			</div>
    			</div>
    			</li>";
    		}else if($v['openid'] == $openid){//自己回答
    			$ret .= "<li class='li2'>
    			<img src='{$v['headimgurl']}'>
    			<div class='broadcast_ul_d1'>
    			<P class='broadcast_ul_d1_p1'><span class='broadcast_ul_d1_p1_s1'>{$name}</span><span class='broadcast_ul_d1_p1_s2'>{$v['time']}</span></P>
    			<div class='qp'>
    			<img class='qp_img' src='/Public/ke/img/qp1.png'>
    			<P class='broadcast_ul_d1_p2'>{$v['contents']}</P>
    			</div>
    			</div>
    			</li>";
    		}else{//别人
    			$ret .= "<li>
    			<img src='{$v['headimgurl']}'>
    			<div class='broadcast_ul_d1'>
    			<P class='broadcast_ul_d1_p1'><span class='broadcast_ul_d1_p1_s1'>{$name}</span><span class='broadcast_ul_d1_p1_s2'>{$v['time']}</span></P>
    			<div class='qp'>
    			<img class='qp_img' src='/Public/ke/img/qp2.png'>
    			<P class='broadcast_ul_d1_p2'>{$v['contents']}</P>
    			</div>
    			</div>
    			</li>";
    		}
    	}
    	echo $ret;
    	exit;
    }
    
    //300元领券
    public function quanxinxi(){
    	if($this->isPost()){
    		$data = $_POST;
    		$data['title'] = '300元现金券';
    		$data['addtime'] = date("Y-m-d H:i:s",time());
    		$db = M('hdquan');
    		$dd = $db->where("shouji='{$data['shouji']}' and title='{$data['title']}'")->find();
    		if($dd){
    			$this->error("您已领取，不能重复领取！");
    		}else{
    			if($db->add($data)){
    				parent::yuanMsg($data['shouji'],'恭喜您获得300元现金抵用券，请于8月15日使用，过时无效，详情咨询李老师：18046552547');//发送验证信息
    			}
    			$this->display('quanling');
    		}
    	}else{
    		$this->display();
    	}
    	
    }
    
    //200元精英月嫂现金券
    public function quanxinxi1(){
    	if($this->isPost()){
    		$data = $_POST;
    		$data['title'] = '200元精英月嫂现金券';
    		$data['addtime'] = date("Y-m-d H:i:s",time());
    		$db = M('hdquan');
    		$dd = $db->where("shouji='{$data['shouji']}' and title='{$data['title']}'")->find();
    		if($dd){
    			$this->error("您已领取，不能重复领取！");
    		}else{
    			if($db->add($data)){
    				parent::yuanMsg($data['shouji'],'恭喜您获得200元现金抵用券，请于8月17日使用，过时无效，详情咨询李老师：15001328927');//发送验证信息
    			}
    			$this->display('quanling1');
    		}
    	}else{
    		$this->display();
    	}
    	 
    }
    
    //班长主页
    public function banzhang(){
    	if(!$_GET['openid']){
    		header("Location: http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/banzhang");
    		die;
    	}
    	$openid = $this->_get('openid');
    	$this->assign('openid',$openid);
    	if(!$openid) $openid = 'null';
    	$user = M('user_weixin',' ')->where("openid='{$openid}'")->find();
    	if(!$user){
    		$this->display();
    		die;
    	}
    	if($user['bunionid']){
    		$ban = M('user_weixin',' ')->where("unionid='{$user['bunionid']}'")->find();
    		$user['ban'] = $ban['nickname'];
    	}
    	//待转入金额
    	$tixian = M('banjine','t_')->field('sum(jine) as jine')->where("openid='{$openid}' and state = 0")->find();
    	$user['jine'] = $user['jine']+$tixian['jine'];
    	$this->assign('arr',$user);
    	//查询所有粉丝
    	if($user['unionid']){
    		$fencount = M('user_weixin',' ')->where("bunionid='{$user['unionid']}'")->count();
    		$this->assign('fencount', $fencount);
    		//查询总消费
    		$tab = 'user_weixin wx,dingdan dd';
    		$where = "wx.bunionid = '{$user['unionid']}' and dd.state=1 and wx.openid = dd.userid";
    		$zjine = M()->table($tab)->field('sum(dd.money) as money')->where($where)->select();
    		$zjine = $zjine[0]['money'];
    		$this->assign('zjine',$zjine);
    		//判断星级,修改星级
    		if($zjine > 3000){
    		
    		}else{
    		
    		}
    	}else{
    		$this->assign('fencount', 0);
    	}
    	
    	$ban = M('banzhang');
    	$ji = $ban->where("openid='{$openid}'")->find();
    	//判断是否成为班长
    	if($ji){
    		$this->assign('ji',1);
    	}else{
    		if($user['phone']){
    			$ji = $ban->where("phone='{$user['phone']}'")->find();
    			if($ji){
    				$ban->where("id='{$ji['id']}'")->setField('openid',$openid);
    				$this->assign('ji',1);
    			}else{
    				$this->assign('ji',0);
    			}
    		}else {
    			$this->assign('ji',0);
    		}
    	}
    	$this->display();
    }
    
    //班长报名
    public function baoming(){
    	if($this->isPost()){
    		$openid = $_POST['openid'];
    		$wx = M('banzhang')->where("openid='{$openid}'")->find();
    		if(!$wx){
    			$_POST['addtime'] = date('Y-m-d H:i:s');
    			M('banzhang')->add($_POST);
    		}
    		$this->redirect('ke/banma',array('openid'=>$openid));
    	}
    	 
    }
    
    //班长报名
    public function banbaoming(){
    	if($this->isPost()){
    		$openid = $_POST['openid'];
    		$zhengshu = implode(',',$_POST['zhengshu']);
    		if($_POST['zhengshu1']){
    			$zhengshu .= ','.$_POST['zhengshu1'];
    		}
    		$_POST['zhengshu'] = $zhengshu;
    		$wx = M('banzhang')->where("openid='{$openid}'")->find();
    		$_POST['addtime'] = date('Y-m-d H:i:s');
    		if(!$wx){
    			M('banzhang')->add($_POST);
    		}
    		$this->redirect('ke/banma',array('openid'=>$openid));
    	}else{
    		$openid = $this->_get('openid');
    		$this->assign('openid',$openid);
    		$this->display();
    	}
    	
    }
    
    //班长登录
    public function login(){
    	if($this->isPost()){
    		$openid = $_POST['openid'];
    		$zhengshu = implode(',',$_POST['zhengshu']);
    		if($_POST['zhengshu1']){
    			$zhengshu .= ','.$_POST['zhengshu1'];
    		}
    		$_POST['zhengshu'] = $zhengshu;
    		$wx = M('banzhang')->where("openid='{$openid}'")->find();
    		$_POST['addtime'] = date('Y-m-d H:i:s');
    		if(!$wx){
    			M('banzhang')->add($_POST);
    		}
    		$this->redirect('ke/banma',array('openid'=>$openid));
    	}else{
    		$openid = $this->_get('openid');
    		$this->assign('openid',$openid);
    		$this->display();
    	}
    	 
    }
    
    //我的二维码
    public function banmas(){
    	$openid = $this->_get('openid');
    	$ban = M('banzhang')->where("openid='{$openid}'")->find();
    	if(!$ban){
    		$this->assign('openid',$openid);
    		$this->display();
    		exit;
    	}
    	$wx = M('weixin','user_')->where("openid='{$openid}'")->find();
    	$dst_path = 'Public/ban/qimg.jpg';//背景图
    	$src_path = 'Public/ban/qrcode.png';//二维码
    	$sus_path = 'Public/ban/sus.png';//微信图像
    	$value = 'http://m.mumway.com/yuesao/banzhang.php?uid='.$wx['unionid'];
    	$text = $wx['nickname'];//昵称
    	vendor("phpqrcode");
		//生成二维码图片1网站，2生成图片路径，3容错级别，4生成图片大小
		QRcode::png($value, $src_path, 'L', 4, 2);
		//微信图像
		$url = $wx['headimgurl'];
		$ch = curl_init();
		$httpheader = array(
				'Host' => 'mmbiz.qpic.cn',
				'Connection' => 'keep-alive',
				'Pragma' => 'no-cache',
				'Cache-Control' => 'no-cache',
				'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,/;q=0.8',
				'User-Agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.89 Safari/537.36',
				'Accept-Encoding' => 'gzip, deflate, sdch',
				'Accept-Language' => 'zh-CN,zh;q=0.8,en;q=0.6,zh-TW;q=0.4'
		);
		$options = array(
				CURLOPT_HTTPHEADER => $httpheader,
				CURLOPT_URL => $url,
				CURLOPT_TIMEOUT => 5,
				CURLOPT_FOLLOWLOCATION => 1,
				CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array( $ch , $options );
		$result = curl_exec( $ch );
		curl_close($ch);
		file_put_contents($sus_path, $result );
		$imgage = getimagesize($sus_path); //得到原始大图片
		switch ($imgage[2]) { // 图像类型判断
			case 1:
				$im = imagecreatefromgif($sus_path);
				break;
			case 2:
				$im = imagecreatefromjpeg($sus_path);
				break;
			case 3:
				$im = imagecreatefrompng($sus_path);
				break;
		}
		$tn = imagecreatetruecolor(100, 100); //创建缩略图
		$src_W = $imgage[0]; //获取大图片宽度
		$src_H = $imgage[1]; //获取大图片高度
		imagecopyresampled($tn, $im, 0, 0, 0, 0, 100, 100, $src_W, $src_H); //复制图像并改变大小
		imagepng($tn,$sus_path);//保存个人图片
		//创建图片的实例
		$dst = imagecreatefromstring(file_get_contents($dst_path));
		$src = imagecreatefromstring(file_get_contents($src_path));
		$sus = imagecreatefromstring(file_get_contents($sus_path));//个人图像
		//打上文字
		$font = 'Public/ban/simsun.ttc';//字体
		//$black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//字体颜色黑色
		$black = imagecolorallocate($dst, 0xe6, 0xe6, 0xe6);//字体颜色白色
		imagefttext($dst, 20, 0, 240, 690, $black, $font, $text);
		//获取水印图片的宽高
		list($src_w, $src_h) = getimagesize($src_path);
		//将水印图片复制到目标图片上，最后个参数50是设置透明度，这里实现半透明效果
		imagecopymerge($dst, $src, 280, 870, 0, 0, $src_w, $src_h, 100);
		imagecopymerge($dst, $sus, 50, 640, 0, 0, 100, 100, 100);
		//输出图片
		list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
		switch ($dst_type) {
			case 1://GIF
				header('Content-Type: image/gif');
				imagegif($dst);
				//imagegif($dst,$iname.'.gif');
				break;
			case 2://JPG
				header('Content-Type: image/jpeg');
				imagejpeg($dst);
				//imagejpeg($dst,$iname.'.jpg');
				break;
			case 3://PNG
				header('Content-Type: image/png');
				imagepng($dst);
				//imagepng($dst,$iname.'.png');
				break;
			default:
				break;
		}
		imagedestroy($dst);
		imagedestroy($src);
		imagedestroy($sus);
    	$this->display();
    }
    
    //我的二维码
    public function banma(){
    	$openid = $this->_get('openid');
    	$ban = M('banzhang')->where("openid='{$openid}'")->find();
    	if(!$ban){
    		$this->assign('openid',$openid);
    		$this->display();
    		exit;
    	}
    	$wx = M('weixin','user_')->where("openid='{$openid}'")->find();
    	$dst_path = 'Public/ban/rili.png';//背景图
    	$src_path = 'Public/ban/qrcode.png';//二维码
    	$value = 'http://m.mumway.com/yuesao/banzhang.php?uid='.$wx['unionid'];
    	vendor("phpqrcode");
    	//生成二维码图片1网站，2生成图片路径，3容错级别，4生成图片大小
    	QRcode::png($value, $src_path, 'L', 4, 2);
    	//创建图片的实例
    	$dst = imagecreatefromstring(file_get_contents($dst_path));
    	$src = imagecreatefromstring(file_get_contents($src_path));
    	//获取水印图片的宽高
    	list($src_w, $src_h) = getimagesize($src_path);
    	//将水印图片复制到目标图片上，最后个参数50是设置透明度，这里实现半透明效果
    	imagecopymerge($dst, $src, 450, 830, 0, 0, $src_w, $src_h, 100);
    	//输出图片
    	list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
    	switch ($dst_type) {
    		case 1://GIF
    			header('Content-Type: image/gif');
    			imagegif($dst);
    			//imagegif($dst,$iname.'.gif');
    			break;
    		case 2://JPG
    			header('Content-Type: image/jpeg');
    			imagejpeg($dst);
    			//imagejpeg($dst,$iname.'.jpg');
    			break;
    		case 3://PNG
    			header('Content-Type: image/png');
    			imagepng($dst);
    			//imagepng($dst,$iname.'.png');
    			break;
    		default:
    			break;
    	}
    	imagedestroy($dst);
    	imagedestroy($src);
    	$this->display();
    }
    
    //全部粉丝
    public function banfen1(){
    	$openid = $this->_get('openid');
    	$this->assign('openid',$openid);
    	if (!$openid){
    		$this->display();
    		exit;
    	}
    	//查询当前用户信息
    	$user = M('user_weixin',' ')->where("openid='{$openid}'")->find();
    	if(!$user['unionid']){
    		$this->display();
    		exit;
    	}
    	//查询所有粉丝
    	$fencount = M('user_weixin',' ')->where("bunionid='{$user['unionid']}'")->count();
    	$this->assign('fencount',$fencount);
    	//查询已购买
    	$tab = 'user_weixin uw,dingdan dd';
    	$where = "wx.bunionid = '{$user['unionid']}' and dd.state=1 and wx.openid = dd.userid";
    	$yicount = M()->table($tab)->field('wx.*')->where($where)->group('wx.openid')->select();
    	$yicount =  count($yicount);
    	$this->assign('yicount',$yicount);
    	//查询未够买
    	$weicount = $fencount - $yicount;
    	$this->assign('weicount',$weicount);
    	//查询总消费
    	$tab = 'user_weixin wx,dingdan dd';
    	$where = "wx.bunionid = '{$user['unionid']}' and dd.state=1 and wx.openid = dd.userid";
    	$zjine = M()->table($tab)->field('sum(dd.money) as money')->where($where)->select();
    	$zjine = $zjine[0]['money'];
    	$this->assign('zjine',$zjine);
    	//显示页面
    	$tab = 'user_weixin wx,dingdan dd';
    	$where = "wx.bunionid = '{$user['unionid']}' and dd.state=1 and wx.openid = dd.userid";
    	$list = M()->table($tab)->field('wx.*,sum(dd.money) as money')->where($where)->group('wx.openid')->select();
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //已够粉丝
    public function banfen2(){
    	$openid = $this->_get('openid');
    	$this->assign('openid',$openid);
    	if (!$openid){
    		$this->display();
    		exit;
    	}
    	//查询当前用户信息
    	$user = M('weixin','user_')->where("openid='{$openid}'")->find();
    	if(!$user['unionid']){
    		$this->display();
    		exit;
    	}
    	//查询已购买
    	$tab = 'user_weixin wx,dingdan dd';
    	$where = "wx.bunionid = '{$user['unionid']}' and dd.state=1 and wx.openid = dd.userid";
    	$yicount = M()->table($tab)->field('wx.*')->where($where)->group('wx.openid')->select();
    	$yicount =  count($yicount);
    	$this->assign('yicount',$yicount);
    	//查询总消费
    	$tab = 'user_weixin wx,dingdan dd';
    	$where = "wx.bunionid = '{$user['unionid']}' and dd.state=1 and wx.openid = dd.userid";
    	$zjine = M()->table($tab)->field('sum(dd.money) as money')->where($where)->select();
    	$zjine = $zjine[0]['money'];
    	$this->assign('zjine',$zjine);
    	//显示页面
    	$tab = 'user_weixin wx,dingdan dd';
    	$where = "wx.bunionid = '{$user['unionid']}' and dd.state=1 and wx.openid = dd.userid";
    	$list = M()->table($tab)->field('wx.*,sum(dd.money) as money')->where($where)->group('wx.openid')->select();
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //购买粉丝详细
    public function banfen21() {
    	$openid = $this->_get('openid');
    	$this->assign('openid',$openid);
    	$sopenid = $this->_get('sopenid');
    	$this->assign('sopenid',$sopenid);
    	//查询当前用户信息
    	$user = M('weixin','user_')->where("openid='{$sopenid}'")->find();
    	if($user['addtime']){
    		$user['addtime'] = substr($user['addtime'],0,10);
    	}
    	$lists = M('dingdan',' ')->where("userid='{$sopenid}' and state=1")->order('id desc')->select();
    	$weekarray=array("周日","周一","周二","周三","周四","周五","周六");
    	$list = array();
    	$jine = 0;
    	foreach ($lists as $v){
    		if($v['ADDTIME']){
    			$tm = strtotime($v['ADDTIME']);
    			$xq = date('w', $tm);
    			$v['XQ'] = $weekarray[$xq];
    			$v['DATE'] = date('m-d', $tm);
    			$list[] = $v;
    		}
    		$jine += $v['MONEY'];
    	}
    	$user['jine'] = $jine;
    	$this->assign('user',$user);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //未够粉丝
    public function banfen3(){
    $openid = $this->_get('openid');
    	$this->assign('openid',$openid);
    	if (!$openid){
    		$this->display();
    		exit;
    	}
    	//查询当前用户信息
    	$user = M('weixin','user_')->where("openid='{$openid}'")->find();
    	if($user['unionid']){
    		//显示页面
    		$where = "bunionid = '{$user['unionid']}' and openid not in (select wx.openid from user_weixin wx,dingdan dd where wx.bunionid = '{$user['unionid']}' and dd.state=1 and wx.openid = dd.userid group by wx.openid)";
    		$list = M('weixin','user_')->where($where)->select();
    		//查询未够买
    		$weicount = M('weixin','user_')->where($where)->count();
    		$this->assign('weicount',$weicount);
    	}
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //班长会员中心
    public function banhuiyuan(){
    	$openid = $this->_get('openid');
    	$this->assign('openid',$openid);
    	$arr = M('weixin','user_')->where("openid='{$openid}'")->find();
    	$this->assign('arr',$arr);
    	$this->display();
    }
    
    //班长会员提现
    public function bantixian(){
    	$openid = $this->_get('openid');
    	$arr = M('weixin','user_')->where("openid='{$openid}'")->find();
    	$this->assign('openid',$openid);
    	if(!$openid){
    		$openid = null;
    	}
    	$ti = date('Y-m-d H:i:s',strtotime('-1 month'));
    	//可转金额
    	$tixian = M('banjine')->field('sum(jine)')->where("openid='{$openid}' and addtime<'{$ti}' and state = 0")->find();
    	if($tixian['jine']){
    		M('banjine')->where("openid='{$openid}' and addtime<'{$ti}' and state = 0")->setField('state',1);
    		$arr['jine'] = $arr['jine']+$tixian['jine'];
    		M('weixin','user_')->where("openid='{$openid}'")->setField('jine',$arr['jine']);
    	}
    	//待转入金额
    	$tixian = M('banjine')->field('sum(jine) as jine')->where("openid='{$openid}' and state = 0")->find();
    	if($tixian['jine']){
    		$arr['djine'] = $tixian['jine'];
    	}else{
    		$arr['djine'] = 0;
    	}
    	$this->assign('arr',$arr);
    	//提现记录
    	$tixian = M('bantixian')->where("openid='{$openid}'")->order('id desc')->select();
    	$this->assign('tixian',$tixian);
    	$this->display();
    }
    
    //班长送券
    public function bansongquan(){
	    $openid = $this->_get('openid');//当前用户id
	    $this->assign('openid',$openid);
	    $sopenid = $this->_get('sopenid');//目标用户id
	    $this->assign('sopenid',$sopenid);
	    $arr = M('weixin','user_')->where("openid='{$openid}'")->find();
	    $this->assign('arr',$arr);
	    if($this->_get('qid')){
	    	$qid = $this->_get('qid');
	    	$db = M('youhui_us',' ');
	    	$op = $db->where("id=$qid")->find();
	    	if($op){
	    		$db->where("id=$qid")->setField('shu',$op['shu']-1);//减送券数
	    		//目标用户操作
	    		$om = $db->where("openid='$sopenid' and qid={$op['qid']}")->find();
	    		//有就累加数，没有就添加
	    		if($om){
	    			$db->where("id={$om['id']}")->setField('shu',$om['shu']+1);
	    			echo  $db->getLastsql();
	    		}else{
	    			$dt['qid'] = $op['qid'];
	    			$dt['shu'] = 1;
	    			$dt['openid'] = $sopenid;
	    			$dt['addtime'] = date('Y-m-d H:i:s');
	    			$db->add($dt);
	    		}
	    		$jl['qid'] = $op['qid'];
	    		$jl['openid'] = $openid;
	    		$jl['sopenid'] = $sopenid;
	    		$jl['addtime'] = date('Y-m-d H:i:s');
	    		$jl['shu'] = 1;
	    		M('youhui_us_ban',' ')->add($jl);
	    	}
	    	$this->redirect('ke/bansongquan',array('openid'=>$openid,'sopenid'=>$sopenid));
	    	exit();
	    }
	    if(!$openid) $openid = 'null';
	    $tab = 'youhui yh, youhui_us us';
	    $wr = "us.shu > 0 and yh.zsong=1 and us.openid = '{$openid}' and yh.id = us.qid";
	    $list = M()->table($tab)->field('yh.*,us.shu as shu,us.id as qid')->where($wr)->select();
	    $this->assign('list',$list);
	    $this->display();
    }
    
    
    
    //简历
    public function jianli(){
    	$hw = M('houseworker');
    	$id = 0;
    	$openid = $_GET['openid'];
    	$user = $this->user($openid);
    	if($user['hid']){
    		$id = $user['hid'];
    	}elseif ($user[0]){
    		M('weixin','user_')->where("openid='{$openid}'")->setField('hid',$user[0]['id']);
    		$id = $user[0]['id'];
    	}
    	//$id = 5899;
    	$arr = $hw->where("id=$id")->find();
    	if($this->isPost()){
    		$file = $_FILES['pic'];//得到传输的数据
    		//头像
    		if($file['name'] && $id != 0){
    			import('ORG.Net.UploadFile');// 文件上传
    			$upload = new UploadFile();// 实例化上传类
    			$upload->maxSize  = 3145728 ;// 设置附件上传大小
    			$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    			$upload->savePath =  'Public/uploads/pic/';
    			$upload->saveRule='uniqid';
    			$upload->thumb = true;
    			$upload->thumbMaxWidth = 200;
    			$upload->thumbMaxHeight = 200;
    			$upload->thumbRemoveOrigin = true;
    			if(!$upload->upload()) {// 上传错误提示错误信息
    				echo $upload->getErrorMsg();die;
    			}else{
    				$info = $upload->getUploadFileInfo();
    				$pic=$info[0]['savepath'].'thumb_'.$info[0]['savename'];
    				$d['pic'] = $pic;
    				M('houseworker')->where('id='.$id)->setField($d);
    			}
    		}
    		$file = $_FILES['file'];//得到传输的数据
    		//相册
    		if($file['name'] && $id != 0){
    			//得到文件名称
    			$name = $file['name'];
    			//得到文件类型，并且都转化成小写
    			$type = strtolower(substr($name,strrpos($name,'.')+1)); 
    			//定义允许上传的类型
    			$allow_type = array('jpg','jpeg','gif','png');
    			//判断文件类型是否被允许上传,如果不被允许，则直接停止程序运行  
    			if(!in_array($type, $allow_type)){
    				return ;
    			}
    			//判断是否是通过HTTP POST上传的,如果不是通过HTTP POST上传的  
    			if(!is_uploaded_file($file['tmp_name'])){
    				return ;
    			}
    			//上传文件的存放路径
    			$path = "Public/uploads/xiangce/$id/";
    			if(!is_dir($path)){
    				mkdir($path);
    			}
    			$path .= rand(10,100).'.'.$type;//文件路径
    			//开始移动文件到相应的文件夹
    			if(move_uploaded_file($file['tmp_name'],$path)){
    				
    				if(!empty($arr['pics'])){
    					$hw->where("id=$id")->setField('pics',$arr['pics'].'|'.$path);
    				}else{
    					$hw->where("id=$id")->setField('pics',$path);
    				}
    			}
    		}
    		
    		$file = $_FILES['zhengshu'];//得到传输的数据
    		//证件
    		if($file['name'] && $id != 0){
    			//得到文件名称
    			$name = $file['name'];
    			//得到文件类型，并且都转化成小写
    			$type = strtolower(substr($name,strrpos($name,'.')+1));
    			//定义允许上传的类型
    			$allow_type = array('jpg','jpeg','gif','png');
    			//判断文件类型是否被允许上传,如果不被允许，则直接停止程序运行
    			if(!in_array($type, $allow_type)){
    				return ;
    			}
    			//判断是否是通过HTTP POST上传的,如果不是通过HTTP POST上传的
    			if(!is_uploaded_file($file['tmp_name'])){
    				return ;
    			}
    			//上传文件的存放路径
    			$path = "Public/uploads/zhengjian/$id/";
    			if(!is_dir($path)){
    				mkdir($path);
    			}
    			$path .= rand(10,100).'.'.$type;//文件路径
    			//开始移动文件到相应的文件夹
    			if(move_uploaded_file($file['tmp_name'],$path)){
    				$dt['name'] = $_POST['name'];
    				$dt['houser_id'] = $id;
    				$dt['pic'] = $path;
    				$dt['addtime'] = date('Y-m-d H:i:s',time());
    				M('zhengjian')->add($dt);
    			}
    		}
    		
    		//特长
    		if('skill' == $_POST['namet'] && $id != 0){
    			if($_POST['skill']){
    				$skill = implode(',',$_POST['skill']);
    			}
    			if($_POST['skill1']){
    				if($skill){
    					$skill = $skill.','.$_POST['skill1'];
    				}else{
    					$skill = $_POST['skill1'];
    				}
    				
    			}
    			$hw->where("id=$id")->setField('skill',$skill);
    		//空档
    		}elseif ('kongdang' == $_POST['namet'] && $id != 0){
    			$data['start_kongdang'] = $arr['start_kongdang'].','.$_POST['start_kongdang'];
    			$data['end_kongdang'] = $arr['end_kongdang'].','.$_POST['end_kongdang'];
    			$hw->where("id=$id")->setField($data);
    		//基本信息
    		}elseif ('jiben' == $_POST['namet']){
    			if($id){
    				$hw->where("id=$id")->setField($_POST);
    			}else{
    				//根据身份证查询当前用户
    				$arr = $hw->where("idcard={$_POST['idcard']}")->find();
    				if($arr){
    					$id = $arr['id'];
    					$hw->where("id=$id")->setField($_POST);
    					M('weixin','user_')->where("openid='{$openid}'")->setField('hid',$id);
    				}else{
    					$_POST['static'] = 4;//为微信
    					$id = $hw->add($_POST);
    					M('weixin','user_')->where("openid='{$openid}'")->setField('hid',$id);
    				}
    				
    			}
    			
    		//期望
    		}elseif ('qiuzhi' == $_POST['namet'] && $id != 0){
    			$_POST['houser_id'] = 1335;
    			M("qiuzhi")->add($_POST);
    		}
    		
    	}
    	$tij = 1;//判断是否可以提交简历
    	$titi = '';//判断是否可以提交显示文字
    	$arr = $hw->where("id=$id")->find();
    	//星级图
    	$xj = M()->table('t_newhourse tn,t_hwlevel th')->field('th.*')->where("tn.hourse_id = $id and tn.name='母婴护理师' and tn.pingding_a = th.name")->find();
    	if($xj){
    		$arr['xingji'] = $xj['xzhan'];
    	}else{
    		$arr['xingji'] = '6,6,6,6,6,6';
    	}
    	$this->assign('arr',$arr);
    	if(!$arr['pic']){
    		$tij = 0;
    		if(!$titi) $titi = "请点击头图上传图片";
    	}
    	if(!$arr['idcard']){
    		$tij = 0;
    		if(!$titi) $titi = "请添加个人资料中的身份证";
    	}
    	if(!$arr['area_id']){
    		$tij = 0;
    		if(!$titi) $titi = "请添加个人资料中的籍贯";
    	}
    	if(!$arr['age']){
    		$tij = 0;
    		if(!$titi) $titi = "请添加个人资料中的年龄";
    	}
    	if(!$arr['school_type']){
    		$tij = 0;
    		if(!$titi) $titi = "请添加个人资料中的学历";
    	}
    	if(($arr['experence_year_yuesao']+$arr['experence_year_yuying']) <= 0){
    		$tij = 0;
    		if(!$titi) $titi = "请添加个人资料中的学历";
    	}
    	//获取阿姨特长
    	$skill = strpos($arr['skill'],",");
    	if($skill){
    		$skill =  explode(",", $arr['skill']) ;
    		$this->assign('skill',$skill);
    	}elseif(!empty($arr['skill'])){
    		$skill[0] = $arr['skill'];
    		$this->assign('skill',$skill);
    	}
    	if(!$skill){
    		$tij = 0;
    		if(!$titi) $titi = "请添加特长";
    	}
    	//获取阿姨上户照片
    	$shu = strpos($arr['pics'],"|");
    	if($shu){
    		$shanghu =  explode("|", $arr['pics']) ;
    		$this->assign('shanghu',$shanghu);
    	}elseif(!empty($arr['pics'])){
    		$shanghu[0] = $arr['pics'];
    		$this->assign('shanghu',$shanghu);
    	}
    	if(!$shu){
    		$tij = 0;
    		if(!$titi) $titi = "请上传上户照片";
    	}
    	//获取阿姨期望工作
    	$qiuzhi = M("qiuzhi")->where("houser_id=$id")->order('id desc')->select();
    	$this->assign('qiuzhi',$qiuzhi);
    	if(!$qiuzhi){
    		$tij = 0;
    		if(!$titi) $titi = "请添加期望工作";
    	}
    	//证书
    	$zhengjians = M("zhengjian")->where('houser_id='.$id)->select();
    	$this->assign('zhengjians',$zhengjians);
    	if(!$zhengjians){
    		$tij = 0;
    		if(!$titi) $titi = "请上传证书";
    	}
    	//证书类型
    	$zjitem = M("hwpaper")->select();
    	$this->assign('zjitem',$zjitem);
    	//空档日期
    	$start_t = explode(",", $arr['start_kongdang']);
    	$end_t = explode(",", $arr['end_kongdang']);
    	if($arr['start_kongdang']){
    		for ($i = 0; $i < count($start_t); $i++){
    			$kongdang[] = $start_t[$i].'—至—'.$end_t[$i];
    		}
    	}
    	$this->assign('kongdang',$kongdang);
    	if(!$kongdang){
    		$tij = 0;
    		if(!$titi) $titi = "请添加空档期";
    	}
    	$this->assign('tij',$tij);
    	$this->assign('titi',$titi);
    	$this->assign('id',$id);
    	$this->assign('gid',$_GET['gid']);//雇主id
    	$this->assign('openid',$openid);
    	$this->display();
    	
    }
    
    //二维数组排序
   public function my_sort($arrays,$sort_key,$sort_order=SORT_ASC,$sort_type=SORT_NUMERIC ){
   	//$list = $this->my_sort($list,'updatetime','SORT_DESC');
    	if(is_array($arrays)){
    		foreach ($arrays as $array){
    			if(is_array($array)){
    				$key_arrays[] = $array[$sort_key];
    			}else{
    				return false;
    			}
    		}
    	}else{
    		return false;
    	}
    	array_multisort($key_arrays,$sort_order,$sort_type,$arrays);
    	return $arrays;
    }
    
    //就业
    public function jiuye(){
    	if(!$_GET['openid']){
    		header("Location: http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/jiuye");
    		die;
    	}
    	
    	$where = "am.disabled=0";
    	//$where = " and ms.is_display=1";
    	//经纪人在刚，雇主是显示
    	//地方
    	if($_GET['gz_city']){
    		$where .= " and ms.gz_city = {$_GET['gz_city']}";
    	}
    	//工资
    	if($_GET['gz_payfee']){
    		$where .= " and ms.gz_payfee = {$_GET['gz_payfee']}";
    	}
    	//经验
    	if($_GET['exprience']){
    		$where .= " and ms.exprience = '{$_GET['exprience']}'";
    	}
    	$where .= ' and ms.prostatus in (0,1,2,3,4,8)';
    	$where .= " and ms.gz_xiaoshou <> '' and ms.gz_xiaoshou=am.id";
    	$field = 'am.phone as phone,am.username as username,am.pic as pic,ms.gz_payfee as gz_payfee,ms.id as id,ms.gz_payfee as gz_payfee,ms.updatetime as updatetime,ms.gz_comment as gz_comment';
    	$list = M()->table('t_master ms,t_admin am')->field($field)->where($where)->order('updatetime desc')->limit(($_GET['beg']*15).',15')->select();
    	$adm_db = M('admin');//经纪人
    	$hr_db = M('hire');//家政与雇主关系表
    	$mp_db = M('masterpayfee');//工资表
    	$mt_db = M('master');//雇主
    	for($i=0;$i<count($list);$i++){
    		$arr = $list[$i];
    		$mp = $mp_db->where("id={$arr['gz_payfee']}")->find();
    		$arr['count'] = $hr_db->where("guzhu_id={$arr['id']}")->count();
    		$arr['payfee'] = $mp['payfee'];
    		//$arr['updatetime'] = date('Y年m月d日',$arr['updatetime']);
    		$arr['updatetime'] = date('Y年m月d日',$arr['updatetime']);
    		$list[$i] = $arr;
    		
    	}
    	if($_GET['beg']>0){
    		$str = '';
    		foreach ($list as $li){
    			$srt = U('ke/jianli',array('openid'=>$_GET['openid'],'gid'=>$li['id']),'');
    			$str .= '<li>
                 <a class="a">
                     <div class="job_info">
                         <p><img src="http://m2.mumway.com/'.$li['pic'].'" class="job_img" /></p>
                         <P>'.$li['username'].'</P>
                     </div>
           
                     <div class="job_info1">
                         <h3>'.$li['gz_comment'].'</h3>
                         <span class="new-price">'.$li['payfee'].'元/月</span>
                         <p class="job_ul_p"><span>已有'.$li['count'].'人接单</span> | <span>'.$li['updatetime'].'</span></p>
                         <span class="job_button">月嫂单</span>
                     </div>
                 </a>
                 <P class="face_to_face_p3 job_p3"><a class="face_to_face_p3_a1" href="tel:'.$li['phone'].'">电话咨询</a><a class="face_to_face_p3_a2" href="'.$srt.'">我要接单</a></P>
             </li>';
    		}
    		echo $str;die;
    	}
    	
    	$shiqu = M('district')->where("level = 2 and id in (select gz_city from t_master group by gz_city)")->select();
    	$gongzi = $mp_db->select();
    	$this->assign('list',$list);
    	$this->assign('shiqu',$shiqu);
    	$this->assign('gongzi',$gongzi);
    	$this->assign('openid',$_GET['openid']);
    	$this->assign('par',$_GET);
    	$this->display();
    }
    
    public function jiuyesmg(){
    	if($_GET['guyong']){
    		$data['guyong'] = $_GET['guyong'];
    		$data['guzhu_id'] = $_GET['guzhu_id'];
    		$data['struct'] = 0;
    		$hire = M('hire')->where($data)->find();
    		if(!$hire){
    			M('hire')->add($data);
    		}
    	}
    	$arr = M('houseworker')->where("id={$_GET['guyong']}")->find();
    	$this->assign('arr',$arr);
    	$this->display();
    }
    
    //答题
    public function dati(){
    	//章节
    	$sub = array();
    	$sub[17] = '2b817c5197094a88ad8b056cdbb37b7b';//高级育婴第一章
    	$sub[18] = '70334d8af31a48e1a663295caf2bc74a';//高级育婴第二章
    	$sub[19] = '21f1367a44a745579e1c1b505a585749';//高级育婴第三章
    	$sub[20] = 'd8dfb72fd2ea41f6bcaebd253db55942';//高级育婴第四章
    	$sub[21] = '62f536f32d7b47a58a91ff753536545f';//高级育婴第五章
    	$sub[22] = '69dcc4e2ffe9430ba2a4c981c7449024';//高级育婴第六章
    	$sub[23] = '866e2879abf64fdcb5212f6c77a19f5c';//高级母婴护理师第1章
    	$sub[24] = '9d4d86f0697540c68718d8c5f7bc2769';//高级母婴护理师第2章
    	$sub[25] = 'fc4b759a10034019b7d6f18c81a9b8d1';//高级母婴护理师第3章
    	$sub[9] = '9916cb474db64254a442214bb295bb50';//高级催乳师第1章
    	$sub[10] = 'f520836d071d4834b76817e0a9a76d68';//高级催乳师第2章
    	$sub[11] = 'f046a3d12aae4efaad5a04a334017d90';//高级催乳师第3章
    	$sub[12] = '7e8485b6a1c445139aff2c0ff9f602ab';//高级催乳师第4章
    	$sub[26] = '4993624372154c5c814bf12ed34dedc8';//金牌育婴师第一章
    	$sub[27] = 'cfd5cb23e8c44775bfed311436b6b205';//金牌育婴师第二章
    	$sub[28] = '0c5d34a6d2274a5aa88a884a0b7b5365';//金牌育婴师第三章
    	$sub[1] = 'd4f847c488804467977b40562b324ea6';//金牌母婴护理师课程第一章
    	$sub[2] = 'ba31d3c363954ef19242b7b9a14b2913';//金牌母婴护理师课程第二章
    	$sub[3] = 'e3f3961406ce4d3d9982bfca7128586f';//金牌母婴护理师课程第三章
    	$sub[4] = '6c1c206b04fc44f38d50d3a189881148';//金牌母婴护理师课程第四章
    	//套餐
    	$super = array();
    	$super[5] = 'b043db8e35a8461c9b0926457eb75f0e';//高级育婴师
    	$super[6] = '95d197f2876e494f9404646ee8b58b0a';//高级母婴护理师
    	$super[3] = '112dd7066fa74929b011808e486343b9';//高级催乳师课程
    	$super[8] = '18d7605414f9434b8471c4303dc96ab7';//金牌育婴师课程
    	$super[1] = 'ea76e853e4954aca89f5cac0a7ab5803';//金牌母婴护理师课程
    	$cid = 'null';
    	$lit = 10;
    	if('1' == $_GET['type']){
    		$cid = $super[$_GET['cid']];
    		$type = '1';
    		$bpic = 'exam_08.png';
    		$lit = 20;
    	}else{
    		//$cid = $sub[$_GET['cid']];
    		$cid = $super[$_GET['cid']];
    		$type = '2';
    		$bpic = 'exam_07.png';
    		$lit = 10;
    	}
    	$wkar=array('A','B','C','D','E','F');
    	$list = M('question',' ')->where("TEST_ID='$cid'")->order('rand()')->limit($lit)->select();//试题
    	foreach ($list as $ki=>$v){
    		$das = array();
    		$das['title'] = $v['CONTENT'];
    		$daan = explode(';', $v['OPTIONS']);
    		$da = $v['ANSWER'];//正确答案
    		if(strpos($da, ';') !== false){
    			$das['tit'] = "多选题";
    		}else{
    			$das['tit'] = "单选题";
    		}
    		$dali = array();
    		//答案
    		foreach ($daan as $k=>$d){
    			$dd = array();
    			$dd['ta'] = $wkar[$k];
    			$ar = explode('、', $d);
    			if(count($ar) > 1){
    				$dd['ti'] = $ar[1];
    			}else{
    				$dd['ti'] = $d;
    			}
    			//判断对错
    			if (strpos($da, $d) !== false){
    				$dd['da'] = 1;
    			}else{
    				$dd['da'] = 0;
    			}
    			$dali[] = $dd;
    		}
    		$das['daan'] = $dali;
    		$list[$ki] = $das;
    	}
    	$this->assign('openid',$_GET['openid']);
    	$this->assign('cid',$_GET['cid']);
    	$this->assign('type',$type);
    	$this->assign('bpic',$bpic);
    	$this->assign('count',count($list));
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //答题
    public function datiadd(){
    	$_GET['addtime'] = date('Y-m-d H:i:s', time());
    	if(M('classresults')->add($_GET)){
    		echo 1;
    	}else {
    		echo 0;
    	}
    	//http://m.mumway.com/index.php/ke/quzheng1/id/1/openid/olwOsjvawl8HIxfkQUTeGRwC-d8U
    	//$this->redirect("ke/quzheng1",array('id'=>$_GET['sid'],'openid'=>$_GET['uid'],'red'=>'1'));
    }
    
    
    //投票排行榜
    public function atouindex2(){
    	$tp = M('user_weixin_tp',' ');
    	$tpus = M('user_weixin_tpus',' ');
    	$paim = $tp->order("number desc,id asc")->field('id,number')->select();
    	foreach ($paim as $v){
    		$paicon[] = $v['id'];
    	}
    	if($_GET['title']){
    		$_GET['xx'] = 1;
    		if(is_numeric($_GET['title'])){
    			$list = $tp->where("id={$_GET['title']}")->select();
    		}else{
    			$list = $tp->where("name like '%{$_GET['title']}%'")->order("number desc,id asc")->select();
    		}
    	}else{
    		$list = $tp->order("number desc")->limit('50')->select();
    	}
    	//获取已投票
    	$yiyou = $tpus->where("openid='{$_GET['openid']}'")->getField('topenid',true);
    	foreach ($list as $k=>$v){
    		//$v['pai'] = $tp->where("number > {$v['number']}")->count();
    		$pai = array_keys($paicon,$v['id']);//获取排名
    		$v['pai'] = $pai[0]+1;
    		if(in_array($v['openid'], $yiyou)){
    			$v['tou'] = 1;
    		}
    		$list[$k] = $v;
    	}
    	$zi = $tp->where("openid='{$_GET['openid']}'")->find();
    	if($zi){
    		$mi = $paim[99];//排名一百的票数
    		if($mi){
    			$fp = $mi['number']-$zi['number'];
    			if($fp > 0){
    				$_GET['conp'] = $fp;
    			}else{
    				$_GET['conp'] = 0;
    			}
    		}else{
    			$_GET['conp'] = 0;
    		}
    		
    		$_GET['con'] = $tpus->where("topenid='{$_GET['openid']}'")->count();
    		//$pai = $tp->where("number > {$zi['number']}")->count();
    		$pai = array_keys($paicon,$zi['id']);//获取排名
    		$zi['pai'] = $pai[0]+1;
    		if(in_array($zi['openid'], $yiyou)){
    			$zi['tou'] = 1;
    		}
    		$zi['now'] = 'now';
    		$zi['my'] = 'my';
    		array_unshift($list,$zi);
    	}
    	$this->assign('par',$_GET);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //投票排行榜
    public function atouindex(){
    	$tp = M('user_weixin_tp',' ');
    	$tpus = M('user_weixin_tpus',' ');
    	$paim = $tp->order("number desc,id asc")->field('id,number')->select();
    	foreach ($paim as $v){
    		$paicon[] = $v['id'];
    	}
    	
    	//获取前三名
    	$list3 = $tp->order("number desc")->limit('3')->select();
    	$this->assign('list3',$list3);
    	//获取自己已投票
    	$yiyou = $tpus->where("openid='{$_GET['openid']}'")->getField('topenid',true);
    	//条件查询
    	if($_GET['title']){
    		if(is_numeric($_GET['title'])){
    			$list = $tp->where("id={$_GET['title']}")->select();
    		}else{
    			$list = $tp->where("name like '%{$_GET['title']}%'")->order("number desc,id asc")->select();
    		}
    		foreach ($list as $k=>$v){
    			//$v['pai'] = $tp->where("number > {$v['number']}")->count();
    			$pai = array_keys($paicon,$v['id']);//获取排名
    			$v['pai'] = $pai[0]+1;
    			if(in_array($v['openid'], $yiyou)){
    				$v['tou'] = 1;
    			}
    			$list[$k] = $v;
    		}
    	}else{
    		$lists[] = $tp->where("id=".$paicon[0])->find();
    		$lists[] = $tp->where("id=".$paicon[49])->find();
    		$lists[] = $tp->where("id=".$paicon[99])->find();
    		$lists[] = $tp->where("id=".$paicon[149])->find();
    		$lists[] = $tp->where("id=".$paicon[199])->find();
    		$lists[] = $tp->where("id=".$paicon[249])->find();
    		$lists[] = $tp->where("id=".$paicon[299])->find();
    		$lists[] = $tp->where("id=".$paicon[349])->find();
    		$lists[] = $tp->where("id=".$paicon[399])->find();
    		$lists[] = $tp->where("id=".$paicon[449])->find();
    		foreach ($lists as $k=>$v){
    			$pai = array_keys($paicon,$v['id']);//获取排名
    			$v['pai'] = $pai[0]+1;
    			if(in_array($v['openid'], $yiyou)){
    				$v['tou'] = 1;
    			}
    			$lists[$k] = $v;
    		}
    		//获取自己信息
    		$zi = $tp->where("openid='{$_GET['openid']}'")->find();
    		$mi = $paim[99];//排名一百的票数
    		$_GET['con'] = 0;
    		$_GET['conp'] = $mi['number'];
    		if($zi){
    			if($mi){
    				$fp = $mi['number']-$zi['number'];
    				if($fp > 0){
    					$_GET['conp'] = $fp;
    				}else{
    					$_GET['conp'] = 0;
    				}
    			}else{
    				$_GET['conp'] = 0;
    			}
    		
    			$_GET['con'] = $tpus->where("topenid='{$_GET['openid']}'")->count();
    			$pai = array_keys($paicon,$zi['id']);//获取排名
    			$zi['pai'] = $pai[0]+1;
    			if(in_array($zi['openid'], $yiyou)){
    				$zi['tou'] = 1;
    			}
    			if(1<=$zi['pai'] && $zi['pai'] <=10){
    				$zi['ma']='';
    			//	51-55、151-155、251-255、351-355
    			}elseif (51<=$zi['pai'] && $zi['pai'] <=55){
    				$zi['ma']='188.png';
    			}elseif (151<=$zi['pai'] && $zi['pai'] <=155){
    				$zi['ma']='188.png';
    			}elseif (251<=$zi['pai'] && $zi['pai'] <=255){
    				$zi['ma']='188.png';
    			}elseif (351<=$zi['pai'] && $zi['pai'] <=355){
    				$zi['ma']='188.png';
    			//	101-110、201-210、301-310、401-410
    			}elseif (101<=$zi['pai'] && $zi['pai'] <=110){
    				$zi['ma']='88.png';
    			}elseif (201<=$zi['pai'] && $zi['pai'] <=210){
    				$zi['ma']='88.png';
    			}elseif (301<=$zi['pai'] && $zi['pai'] <=310){
    				$zi['ma']='88.png';
    			}elseif (401<=$zi['pai'] && $zi['pai'] <=410){
    				$zi['ma']='88.png';
    			}else{
    				if($zi['pai']<=500){
    					$zi['ma']='12.png';
    				}
    			}
    			$list[] = $zi;
    		}
    	}
    	
    	if($_SESSION['panxx']){
    		$_SESSION['panxx'] = $_SESSION['panxx']+1;
    	}else{
    		$_SESSION['panxx'] = 1;//首次进入
    	}
    	$this->assign('par',$_GET);//值
    	$this->assign('list',$list);//自己
    	$this->assign('lists',$lists);//排行
    	$this->display();
    }
    
    //分页
    public function toufen(){
    	if($_GET['ct']){
    		if($_GET['beg'] == 1){
    			$end = 48;
    		}elseif($_GET['beg'] == 450){
    			$end = 50;
    		}else{
    			$end = 49;
    		}
    		$list = M('user_weixin_tp',' ')->order("number desc,id asc")->limit($_GET['beg'].','.$end)->select();
    	}else{
    		$st = 50*$_GET['beg'];
    		$list = M('user_weixin_tp',' ')->order("number desc,id asc")->limit($st.',50')->select();
    	}
    	$tp = M('user_weixin_tp',' ');
    	$paim = $tp->order("number desc,id asc")->field('id,number')->select();
    	foreach ($paim as $v){
    		$paicon[] = $v['id'];
    	}
    	$str = '';
    	foreach ($list as $v){
    		$pai = array_keys($paicon,$v['id']);//获取排名
    		$pai = $pai[0]+1;
    		$str .= "<li>
    			<span class='phb_ul_s1'>{$pai}</span>
    			<img class='phb_ul_img' src='{$v['headimgurl']}'>
    			<div class='phb_ul_d'>
    			<P class='phb_ul_d_p1'><span>{$v['id']}号—{$v['name']}</span><span>当前得票：{$v['number']}</span></P>
    			</div>";
    		/*
    		if($li['tou'] == 1){
    			$str .="<a class='phb_ul_a' href='javascipt:0;'>已投票</a>";
    		}else{
    			$str .="<a class='phb_ul_a' href='javascipt:0;' onclick='toup(this,&quot;{$v['openid']}&quot;,&quot;{$v['name']}&quot;)'>投票</a>";
    		}*/
    		$str .="</li>";
    	}
    	$this->ajaxReturn($str);
    }
    
    //投票
    public function touadd(){
    	$tp = M('user_weixin_tp',' ');
    	$tpus = M('user_weixin_tpus',' ');
    	$con = $tpus->where("openid='{$_GET['openid']}'")->count();
    	if($con > 1){
    		$_GET['err'] = 3;
    	}else{
    		$tu = $tpus->where("openid='{$_GET['openid']}' and topenid='{$_GET['topenid']}'")->find();
    		if($tu){
    			$_GET['err'] = 2;
    		}else{
    			$tpus->add($_GET);
    			$ttp = $tp->where("openid='{$_GET['topenid']}'")->find();
    			if($ttp){
    				$tp->where("id={$ttp['id']}")->setField('number',$ttp['number']+1);
    			}
    			$_GET['con'] = $tpus->where("topenid='{$_GET['topenid']}'")->count();
    			$_GET['err'] = 1;
    		}
    	}
    	$this->ajaxReturn($_GET);
    }
    
    //我的二维码
    public function toujz(){
    	$openid = $this->_get('openid');
    	$zi = M('weixin_tp','user_')->where("openid='{$openid}'")->find();
    	if(!$zi['name']){
    		if(mb_strlen($zi['nickname'],'utf-8') > 3){
    			$zi['name'] = mb_substr($zi['nickname'], 0, 3,'utf-8');
    		}else{
    			$zi['name'] = $zi['nickname'];
    		}
    	}
    	$text = $zi['name'];//昵称
    	$dst_path = 'Public/ban/jiangz.jpg';//背景图
    	//创建图片的实例
    	$dst = imagecreatefromstring(file_get_contents($dst_path));
    	//打上文字
    	$font = 'Public/ban/simsun.ttc';//字体
    	$black = imagecolorallocate($dst, 0x00, 0x00, 0x00);//字体颜色黑色
    	//$black = imagecolorallocate($dst, 0xe6, 0xe6, 0xe6);//字体颜色白色
    	imagefttext($dst, 15, 0, 150, 260, $black, $font, $text);
    	//输出图片
    	list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
    	$ul = "Public/ban/jiangz{$zi['id']}.jpg";
    	switch ($dst_type) {
    		case 1://GIF
    			header('Content-Type: image/gif');
    			imagegif($dst,$ul);
    			//imagegif($dst,$iname.'.gif');
    			break;
    		case 2://JPG
    			header('Content-Type: image/jpeg');
    			imagejpeg($dst,$ul);
    			//imagejpeg($dst,$iname.'.jpg');
    			break;
    		case 3://PNG
    			header('Content-Type: image/png');
    			imagepng($dst,$ul);
    			//imagepng($dst,$iname.'.png');
    			break;
    		default:
    			break;
    	}
    	imagedestroy($dst);
    	$this->assign('ul',$ul);
    	$this->display();
    }

    //面授报名
    public function msbm(){
    	$arr = M('msbm')->where("openid='{$_GET['openid']}'")->find();
    	if(!$arr){
    		$arr['hopenid'] = $_GET['hopenid'];
    	}
    	$arr['openid'] = $_GET['openid'];
    	$this->assign('arr',$arr);
    	$this->display();
    }
    
    //面授报名
    public function msbmadd(){
    	$_POST['addtime'] = date('Y-m-d H:i:s');
    	$arr = M('msbm')->where("openid='{$_POST['openid']}'")->find();
    	if($arr){
    		M('msbm')->where("openid='{$_POST['openid']}'")->save($_POST);
    	}else{
    		M('msbm')->add($_POST);
    	}
    	echo 1;
    }

    //面授报名
    public function msbm1(){
    	$imga=rand(0,100);
    	$imgb=rand(0,100);
    	$imgc=rand(0,100);
    	$imgd=rand(0,100);
    	$list = M('user_weixin',' ')->where("id in ($imga,$imgb,$imgc,$imgd)")->select();
    	$arr = M('user_weixin',' ')->where("openid='{$_GET['openid']}'")->find();
    	$this->assign('arr',$arr);
    	$this->assign('list',$list);
    	$this->assign('par',$_GET);
    	$this->display();
    }
    
    //红包1
    public function hb1(){
    	$arr = M('user_weixin',' ')->where("openid='{$_GET['openid']}'")->find();
    	$this->assign('arr',$arr);
    	$this->display();
    }
    
    //红包2
    public function hb2(){
    	$yhdb = M('youhui_us',' ');
    	//判断是否领取
    	$lq = M('user_weixin_hb',' ')->where("openid='{$_GET['openid']}'")->find();
    	if(!$lq){
    		$tm = date('Y-m-d H:i:s');
    		$hb['openid'] = $_GET['openid'];
    		$hb['addtime'] = $tm;
    		M('user_weixin_hb',' ')->add($hb);
    		//直播券
    		$quan['openid'] = $_GET['openid'];
    		$quan['qid'] = 4;
    		$quan['shu'] = 1;
    		$quan['addtime'] = $tm;
    		$yh = $yhdb->where("openid='{$_GET['openid']}' and qid=4")->find();
    		if($yh){
    			$yhdb->where("openid='{$_GET['openid']}' and qid=4")->setField('shu',$yh['shu']+1);
    		}else{
    			$yhdb->add($quan);
    		}
    		//面授券
    		$quan['qid'] = 11;
    		$yh = $yhdb->where("openid='{$_GET['openid']}' and qid=11")->find();
    		if($yh){
    			$yhdb->where("openid='{$_GET['openid']}' and qid=11")->setField('shu',$yh['shu']+1);
    		}else{
    			$yhdb->add($quan);
    		}
    		//课程30
    		$quan['qid'] = 12;
    		$yh = $yhdb->where("openid='{$_GET['openid']}' and qid=12")->find();
    		if($yh){
    			$yhdb->where("openid='{$_GET['openid']}' and qid=12")->setField('shu',$yh['shu']+1);
    		}else{
    			$yhdb->add($quan);
    		}
    	}
    	$arr = M('user_weixin',' ')->where("openid='{$_GET['openid']}'")->find();
    	$this->assign('arr',$arr);
    	$this->display();
    }
    
}
