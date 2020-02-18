<?php
//手机app接口
class ClassAction extends BaseAction {
	
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
    
    //面授列表
    public function mianshou(){
    	if(!$_GET['openid']){
    		header("Location: http://test.fanqieguanjia.com/toa.php?url=/index.php/class/mianshou");
    		die;
    	}
    	$sc = M('shicao',' ')->select();
    	$list =  array();
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
    public function mianshouxinxi(){
    	$sc = M('shicao',' ')->where("SCID='{$_GET['id']}'")->find();
    	if($sc){
    		if(strpos($sc['SCPICS'], "|")){
    			$shanghu =  explode("|", $sc['SCPICS']);
    			$sc['SCPICS'] = $shanghu[0];
    		}
    		$sc['SCDETAIL'] = nl2br($sc['SCDETAIL']);//换行符转换为html br标签
    	}
    	$this->assign('arr',$sc);
    	$this->assign('openid',$_GET['openid']);
    	$this->display();
    }
    
    //显示地图
    public function ditu(){
    	$this->assign('openid',$_GET['openid']);
    	$this->assign('arr',$_GET);
    	$this->display();
    }
    
    //微信取证课程
    public function quzheng(){
    	if(!$_GET['openid']){
    	    if(empty($_GET['adminId'])){
                header("Location: http://test.fanqieguanjia.com/toa.php?url=/index.php/class/quzheng");
            }else{
                header("Location: http://test.fanqieguanjia.com/toa.php?url=/index.php/class/quzheng/adminId/".$_GET['adminId']);
            }
    		die;
    	}
        //判断是否有招生老师邀请
        if(!empty($_GET['adminId'])){
            //有招生老师 添加到邀请表里 判断是否已经被邀请
            $invite = M('invite')->where(['beinviteId'=>$_GET['openid']])->find();
            if(empty($invite)){
                //没有被邀请
                $temp['adminId'] = $_GET['adminId'];
                $temp['inviteId'] = $_GET['adminId'];
                $temp['beinviteId'] = $_GET['openid'];
//                $temp['classId'] = $classid;
                $temp['time'] = time();
                M('invite')->add($temp);
            }
        }
    	$list = M('superclass')->where("ishow=1")->order("sort asc")->select();
    	$this->assign('openid',$_GET["openid"]);
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //微信取证课详情
    public function quzhengxinxi(){
    	if(!$_GET['vt']){
    		$url = $_SERVER['REQUEST_URI'];
    		if(strpos($url,"?") !== false){
                $url =  substr($url, 0, strpos($url,"?"));//微信分享进来的，需获取openid
            }
            $url .= '/vt/1';
    		header("Location: http://test.fanqieguanjia.com/toa.php?url=$url");
    		die;
    	}

        $openid = $_GET["openid"];
    	$classid = intval($_GET["id"]);
    	$vid = intval($_GET["vid"]);
        $adminId = 0;
        $arr = M('weixin','user_')->where("openid='{$openid}'")->field("id,name,phone")->find();
        if($vid){
            if(strlen($arr["phone"]) < 11){
                $cityM = M('new_admin.city','mumway_');
                $cityList = $cityM->field('id,name')->select();
                $this->assign("rurl", 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
                $this->assign('openid',$openid);
                $this->assign('arr',$arr);
                $this->assign('cityList',$cityList);
                $this->display('bangshouji');
                return ;
            }
        }

        //判断是否已经被邀请
        $invite = M('invite')->where(['beinviteId'=>$openid])->find();
        //判断是否有招生老师邀请
        if(empty($_GET['adminId'])){
            // 邀请人为空  或自然进入  被邀请过切 课程id为空 则修改课程id
            if($invite && empty($invite['classId'])){
                M('invite')->where(['id'=>$invite['id']])->save(['classId'=>$classid]);
            }
            // 邀请人为空 或自然进入 且有邀请人  则获取邀请人
            if($invite && !empty($invite['adminId'])){
                $adminId = $invite['adminId'];
            }
            if(empty($adminId)){
                if(!empty($arr['phone'])){
                    $student = M('new_admin.recruit_student','mumway_')->where(['phone'=>$arr['phone']])->field('id,follow_admin_id')->find();
                    if(!empty($student['follow_admin_id'])){
                        $adminId = $student['follow_admin_id'];
                    }
                }
            }

        }else{
            $adminId = $_GET['adminId'];
        }

        //有邀請人
        if(!empty($_GET['inviteId'])){
            //没有被邀请过
            if(empty($invite)){
                $temp['adminId'] = $adminId;
                $temp['inviteId'] = $_GET['inviteId'];
                $temp['beinviteId'] = $openid;
                $temp['classId'] = $classid;
                $temp['time'] = time();
                // openID不为空  切邀请人和被邀请人不一样  添加
                if(!empty($openid) && $openid != $_GET['inviteId']){
                    M('invite')->add($temp);
                }
            }
        }

    	$this->assign('openid',$openid);
        $this->assign('adminId',$adminId);
    	$classrecord = M("classrecord");//观看记录
    	//课程
    	$cla = M('superclass')->where("id={$classid}")->find();
    	if($cla){
            $inviteUrl = M('invite')->where(['inviteId'=>$openid,'classId'=>$classid,'status'=>1])->select();
            $cla['sumber'] = count($inviteUrl);
            $cla['number'] = ($cla['invitemincount'] - count($inviteUrl))<=0 ?0:($cla['invitemincount'] - count($inviteUrl));
            $cla['imgUrl']='';
            foreach ($inviteUrl as $key => $val){
                $dataUrl = M('weixin','user_')->where(['openid'=>$val['beinviteId']])->find();
                if(empty($dataUrl['headimgurl'])){
                    $cla['imgUrl'] .= ','.'__PUBLIC__/ke/img/qf.png';
                }else{
                    $cla['imgUrl'] .= ','.$dataUrl['headimgurl'];
                }
            }
            if(!empty($cla['imgUrl'])){
                $cla['imgUrl'] = substr($cla['imgUrl'],1);
            }
    		//是否可以观看
    		$uc = M('classuser')->where("userid='{$openid}' and classid={$classid}")->find();
    		$cla["BOUGHT"] = 0;
            $cla["shikan"] = 0;
    		$cla["is_success"] = 0;
    		if($uc){
    			$cla["BOUGHT"] = 1;
    		}else{
    		    $inviteNum = M('invite')->where(['inviteId'=>$openid,'classId'=>$classid,'status'=>1])->count();
    		    if(!empty($cla['invitemincount']) && $inviteNum >= $cla['invitemincount']){
    		        $params['userid'] = $openid;
    		        $params['classid'] = $classid;
    		        $params['addtime']=date("Y-m-d h:i:s", time());
    		        $params["cname"] = '系统';
    		        M('classuser','t_')->add($params);
                    $cla["is_success"] = 1;
    		        $cla["BOUGHT"] = 1;
    		    }
            }
    		//根据点击视频查询
    		$video = M()->table('t_subvoclass s,t_video v')->where("v.id=$vid and s.videoid=v.id")->field("v.*,s.jine")->find();
    		if($video){
    			//获取试看视频
    			if($video["jine"] == 0){
    				$cla["BOUGHT"] = 1;
    				$cla["shikan"] = 1;
    			}
    			$cla["vurl"] = $video["url"];
    			$cla["vid"] = $video["id"];
    			//$cla["pic"] = $video["pic"];
    			$rec = array("vid"=>$vid,"cid"=>$classid,"openid"=>$openid);
    			if(!$classrecord->where($rec)->find()){
    				$rec["addtime"] = date("Y-m-d H:i:s");
    				$classrecord->add($rec);//添加观看记录
    			}
    		}
    		//章节
    		$subclassList = M('subclass')->where("subid='{$classid}' and ishow=1")->order('sort')->select();
    		$classList = array();
    		$videoSum = 0;//视频数

            //是否可以观看
            $data = M('classuser')->where("userid='{$openid}' and classid={$classid}")->find();
    		foreach ($subclassList as $v){
    			//视频
    			$videoList = M()->table('t_subvoclass s,t_video v')->where("s.subid={$v['id']} and s.ishow=1 and s.videoid=v.id")->order('s.sort')->field("v.*,s.jine")->select();
    			if(!$cla["vurl"]){
    				if($videoList){//默认播放第一节视频
    					$cla["vurl"] = $videoList[0]["url"];
    					$cla["vid"] = $videoList[0]["id"];
    				}
    			}
				foreach($videoList as $vk=>$kk){
						$check = $classrecord->where(['openid'=>$openid,'vid'=>$kk['id'],'cid'=>$classid])->find();
						if(empty($check)){  //为空 没学过
							$videoList[$vk]['check'] = 0;
						}else{
							$videoList[$vk]['check'] = 1;
						}

                    $videoList[$vk]['notShikan'] = 0;
                    if(empty($data) && $v['jine'] != 0){
                        $videoList[$vk]['notShikan'] = 1;
                    }
				}
    			$v["video"] = $videoList;
    			$videoSum += count($videoList);
    			$classList[] = $v;
    		}
    		$cla['classList'] = $classList;//章节
    		//随机获取5名学员
    		$cla['wlist'] = M('weixin','user_')->order('rand()')->limit('5')->select();
    		//观看视频数
    		$classrecordSum = $classrecord->where(array("openid"=>$openid,"cid"=>$classid))->count();
    		//判断是否可以考试
    		$cla["istest"] = ($videoSum <= ($classrecordSum+1) ? 1 : 0);
            $cla["isNum"] = 0;
    		if($cla["istest"] == 1){
                $m = M('new_admin.classresults','mumway_');
                $row = $m->where(array("openid"=>$openid,"cid"=>$classid,"time" => date('Y-m-d',time())))->find();
                if(empty($row) || $row['num'] < 3){
                    $cla["isNum"] = 1;
                }
            }
    		//获取视频的url
    		if (strpos($cla["vurl"], "script")){
    			preg_match('/src=\'(.+?)\'.*?>/',str_replace('"',"'",$cla["vurl"]),$match);
    			$cla["vurl"] = $match[1];
    		}
    	}

    	$this->assign('pd',$cla);
    	$this->display();
    }
    
    //支付
    public function zhifu(){
    	$openid = $_GET["openid"];
    	$arr = M('weixin','user_')->where("openid='{$openid}'")->field("name,phone")->find();
    	if(strlen($arr["phone"]) < 11){
            $cityM = M('new_admin.city','mumway_');
            $cityList = $cityM->field('id,name')->select();
    		$this->assign("rurl", 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    		$this->assign('openid',$openid);
    		$this->assign('arr',$arr);
            $this->assign('cityList',$cityList);
    		$this->display('bangshouji');
    		return ;
    	}
    	//套餐
		if($_GET["classid"]){
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
			if($_GET["qid"]){
				$quan = M('youhui',' ')->where("id=".$_GET["qid"])->find();
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
    public function quan(){
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
    	
    	$openid = $_POST["USERID"];
    	if($_POST['MONEY'] == 0){
    		$uc['userid'] = $_POST['USERID'];
    		$uc['classid'] = $_POST['KCID'];
    		$uc['addtime'] = $_POST['ADDTIME'];
    		M('classuser')->add($uc);
    		$url = "http://test.fanqieguanjia.com/index.php/ke/quzheng?openid={$openid}";//支付成功跳转页面
    	}else{
    		$where["USERID"] = $openid;
    		$where["KCID"] = $_POST['KCID'];
    		$where["ADDTIME"] = array('gt',date("Y-m-d", time()));
    		$where["STATE"] = 0;
    		$where["MONEY"] = $_POST['MONEY'];
    		$row = M('dingdan', ' ')->where($where)->find();
    		if($row){
    			$id = $row["ID"];
    			$no = $row["ORDERID"];
    		}else{
    			$no = 'ke'.date("Ymdhis", time());
    			$_POST['ORDERID'] = $no;
    			$id = M('dingdan', ' ')->add($_POST);//添加订单
    		}
    		$zhiurl = base64_encode("http://test.fanqieguanjia.com/index.php/class/quzheng?openid={$openid}");
    		$url = "http://test.fanqieguanjia.com/demo2/pingfu.php?did={$id}&jine={$_POST['MONEY']}&name={$_POST["PAYCONTENT"]}&zhi=wxsuper&zhiurl={$zhiurl}&no={$no}";//支付页面
    	}
    	header("Location: $url");
		die;
    }

    public function zhifukai(){
        $row = M('dingdan', ' ')->where(['ID'=>$_GET['id']])->find();

        if(!empty($row)){
            $params['userid'] = $row['USERID'];
            $params['classid'] = $row['KCID'];
            $arr = M('weixin','user_')
                ->where(["openid"=>$params['userid']])
                ->find();
            if(!empty($arr)){
                $data = M('classuser','t_')->where($params)->find();
                if(empty($data)){
                    $params['addtime']=date("Y-m-d h:i:s", time());
                    $params["cname"] = '系统';
                    M('classuser','t_')->add($params);
                }
            }
        }

        $url = $_GET['url'];
        header("Location: $url");
    }
    
    //我的
    public function wode(){
    	if(!$_GET['openid']){
    		header("Location: http://test.fanqieguanjia.com/toa.php?url=/index.php/class/wode");
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
    	$tab = 't_superclass cl, t_classuser us';
    	$where = "cl.id = us.classid and us.userid = '{$openid}'";
    	$list = M()->table($tab)->field('cl.*,us.addtime as utime')->where($where)->select();
    	$this->assign('list',$list);
    	$this->assign('openid',$openid);
    	$this->display();
    }
    
    //绑定手机
    public function bangshouji(){
    	$db = M('weixin','user_');
        $cityM = M('new_admin.city','mumway_');

    	if($this->isPost()){
    		$openid = $_POST['openid'];
    		$arr = $db->where("openid='{$openid}'")->find();
    		if($arr){
    			$arr['phone'] = $_POST['phone'];
    			$arr['name'] = $_POST['name'];
    			$arr['city_id'] = $_POST['city_id'];
    			$db->where("openid='{$openid}'")->save($arr);
    		}else{
    			$arr['phone'] = $_POST['phone'];
    			$arr['name'] = $_POST['name'];
    			$arr['city_id'] = $_POST['city_id'];
    			$arr['openid'] = $openid;
    			$db->add($arr);
            }
            //判断新添加的手机号是否是有效数据
            $student = M('new_admin.recruit_student','mumway_')->where(['phone'=>$arr['phone']])->find();
            $studentHistory = M('new_admin.recruit_student_history','mumway_')->where(['phone'=>$arr['phone']])->find();
            $main = M('new_admin.houseworker_main','mumway_')->where(['phone'=>$arr['phone']])->find();
            $invite = M('invite')->where(['beinviteId'=>$openid])->find();
            if(empty($main)){
                if(empty($student) && empty($studentHistory)){
                    //没有添加过 是有效数据
                    //判断是否有被邀请过  是则改变邀请状态
                    if($invite){
                        M('invite')->where(['beinviteId'=>$openid])->save(['status'=>1]);
                    }
                }

                $row=array();
                $row['name'] = $_POST['name'];
                $row['phone'] = $_POST['phone'];
                $city = $cityM->field('id,name')->where(['id'=>$_POST['city_id']])->find();
                $row['city'] = $city['name'];
                $row['source_first'] = 128;
                $row['source'] = 129;
                if($invite['adminId']){
                    $row['admin_id'] = $invite['adminId'];
                }
                $row['channel_url'] = 'http://test.fanqieguanjia.com/index.php/class/bangshouji';

//                $this->send_post('http://admin.mumway.com/index/master/saveStudentpublic',$row);
            }

    		if($_POST["rurl"]){
    			//判断是否跳转连接
    			header("Location: ".$_POST["rurl"]);
    			die;
    		}
    		$this->assign('openid',$openid);
    		$this->assign('arr',$arr);
    		$this->display('wode');
    	}else{
    		if(!$_GET['openid']){
    			header("Location: http://test.fanqieguanjia.com/toa.php?url=/index.php/class/bangshouji");
    			die;
    		}
    		$arr = $db->where("openid='{$_GET['openid']}'")->find();
            $cityList = $cityM->field('id,name')->select();
    		$this->assign('openid', $_GET['openid']);
    		$this->assign('arr',$arr);
    		$this->assign('cityId',$arr['city_id']);
    		$this->assign('cityList',$cityList);
    		$this->display();
    	}
    }

    /**
     * 发送post请求
     * @param string $url 请求地址
     * @param array $post_data post键值对数据
     * @return string
     */
    public function send_post($url, $post_data) {
        $postdata = http_build_query($post_data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 15 * 60 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        return $result;
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
    			header("Location: http://test.fanqieguanjia.com/toa.php?url=/index.php/class/fankui");
    			die;
    		}
    		$this->assign('openid', $_GET['openid']);
    		$this->display();
    	}
    	 
    }
    
    //答题
    public function dati(){
    	$cid = $_GET['cid'];
    	$class = M('superclass')->where(array("id"=>$cid))->find();//课程
    	$wkar=array('A','B','C','D','E','F');
    	//试题
    	$list = M('question',' ')
    	->join("class_test on question.TEST_ID=class_test.TEST_ID")
    	->where("class_test.CLASS_ID='$cid'")
    	->order('ORDER_ID asc')
    	->field("question.*")
    	->select();
        $isNum = 0;
        $m = M('new_admin.classresults','mumway_');
        $row = $m->where(array("openid"=>$_GET['openid'],"cid"=>$_GET['cid'],"time" => date('Y-m-d',time())))->find();
        if(empty($row) || $row['num'] < 2){
            $isNum = 1;
        }
    	foreach ($list as $ki=>$v){
    		$das = array();
    		$das['title'] = $v['CONTENT'];
    		$das['answer'] = $v['ANSWER'];//正确答案
    		if(strpos($das['answer'], ';') !== false){
    			$das['type'] = 2;//多选题
    		}else{
    			$das['type'] = 1;//单选题
    		}
    		$dali = array();
    		//答案
    		$daan = explode(';', $v['OPTIONS']);
    		foreach ($daan as $k=>$d){
    			$dd = array();
    			$dd['val'] = $d;
    			$dd['lab'] = $wkar[$k];
    			if(strpos($d, '、') !== false){
    				$dd['con'] = substr($d,strpos($d, '、')+3);
    			}else{
    				$dd['con'] = $d;
    			}
    			$dali[] = $dd;
    		}
    		$das['daan'] = $dali;
    		$list[$ki] = $das;
    	}
    	
    	$this->assign('openid',$_GET['openid']);
    	$this->assign('isNum',$isNum);//是否重新考试
    	$this->assign('cid',$_GET['cid']);//课程ID
    	$this->assign('cname',$class["title"]);//课程名称
    	$this->assign('count',count($list));
    	$this->assign('list',$list);
    	$this->display();
    }
    
    //答题
    public function datiadd(){
    	$m = M('new_admin.classresults','mumway_');
    	$row = $m->where(array("openid"=>$_GET["openid"],"cid"=>$_GET["cid"]))->find();
    	$r = 1;
    	if($row){
            if($row['time'] == date('Y-m-d', time())){
                $m->where(array("openid"=>$_GET["openid"],"cid"=>$_GET["cid"]))->setInc('num');
            }else{
                $m->where(array("openid"=>$_GET["openid"],"cid"=>$_GET["cid"]))->setField(array("num"=>1,"time"=>date('Y-m-d', time())));
            }

    		if($row["fen"] < $_GET["fen"]){
    			$r = $m->where(array("openid"=>$_GET["openid"],"cid"=>$_GET["cid"]))->setField(array("fen"=>$_GET["fen"],"addtime"=>date('Y-m-d H:i:s', time())));
    		}
    	}else{
    		$_GET['addtime'] = date('Y-m-d H:i:s', time());
    		$_GET['time'] = date('Y-m-d', time());
    		$r = $m->add($_GET);
    	}
    	echo $r ? 1 : 0;
    }
    
    //199直播视频
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
    	$course = M('new_admin.mumway_herlive_course',' ')->where("id=".$row['herlive_course_id'])->find();
    	$course['content'] = nl2br($course['content']);
    	$row['course'] = $course;
    	/*//是否显示红包
    	 $share = M('newadmin.mumway_herlive_share',' ')->where("openid='{$openid}' and vid=".$row['id'])->find();
    	 if($share){
    	 $row['isshare'] = 1;
    	 }
    	 //是否答题
    	 $integral = M('newadmin.mumway_herlive_integral',' ')->where("openid='{$openid}'")->find();
    	 if(!$integral){
    	 $row['ista'] = true;
    	 }
    	 */
    	$this->ajaxReturn($row);
    }
    
    //199直播公告
    public function ggajax(){
    	$id = $_POST['id'];
    	$gglist=M("zhibogg","t_")->where("urlid=$id")->order("id desc")->find();
    	echo $gglist["gonggao"];
    }
    
    //199直播评论
    public function getComments(){
    	$list = M()->table('t_zhibopinglun t,new_admin.mumway_herlive_wechat u')
    	->field('t.id,t.contents,t.time,t.reply,u.openid,u.nickname,u.headimgurl')
    	->where("t.openid=u.openid and t.urlid=%d and t.id > %d", $_GET['urlid'], $_GET['id'])
    	->order('t.id desc')
    	->select();
    	if(!$list){
    		$list = array();
    	}
    	$this->ajaxReturn($list);
    }
    
    //199直播添加评论
    public function addComments(){
    	$data = $_POST;
    	$data['time'] = date("Y-m-d H:i:s",time());
    	$id = M('zhibopinglun')->add($data);
    	echo $id;
    	exit;
    }
    
    //199直播列表
    public function videoList(){
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
    
    
}
