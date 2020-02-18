<?php

class MemberModel extends Model {
    //非约束名称时使用
    //protected $tableName = 'tb'; 
    //protected $trueTableName = 'pre_tb';

    public function _initialize(){
        parent::_initialize();

        $this->appointment_status_arr = array('-1'=>'取消预约', '0'=>'已预约，等待客服确认', '1'=>'已确认，等待面试', '2'=>'已调整，等待您的确认', '3'=>'已修改，等待客服重新确认', '4'=>'已面试，重新面试', '5'=>'已签单', '6'=>'无效预约');
    }

    /**
    * 封装返回数据
    */
    private function rt($data, $info, $status){
        return array('data'=>$data, 'info'=>$info, 'status'=>$status);
    }

    /**
    * 密码加密算法
    */
    protected function my_md5($psw, $salt){
        return md5($salt.md5($psw.'think').$salt);
    }

    /**
    * 检查手机号
    */
    public function checkMobile($account){
        if(!$account){
            return $this->rt ( '', '手机号不能为空', 0 );
        }
        $row = $this->where(array('mobile'=>$account))->find();
        if($row){
            return $this->rt ( '', '手机号已经被使用', 0 );
        }else{
            return $this->rt(null, '', 1);
        }
    }

    /**
    * 获取注册手机验证码
    */
    public function getMobilecode($account) {
		$account = $account;
		if (! $account || strlen($account)!=11 ) {
			return $this->rt ( '', '手机号不能为空或格式错误', 0 );
		} else {
            $row = $this->where(array('mobile'=>$account))->find();
            if($row){
                return $this->rt ( '', '手机号已经被使用，请更换其它手机号', 0 );
            }
            
            $db = D('admin://Safecode');
			$row = $db->where(array('account' => $account))->order('add_time DESC')->find();
			if ($row ['add_time'] > time () - 60) {
				return $this->rt ( '', '获取太频繁，获取时间间隔为1分钟', 0 );
			} else {
				$code = $db->getOneSafecode ( $account );
				// 发送注册duanxin
                $srt = $db->sendMsg($account, "尊敬的用户，您的操作验证码为".$code);
                if($srt['status']!=1){
                    //print_r($srt);exit;
                    //return $this->rt ( '', $srt['info'], 0);
                    return $this->rt ( '', '发送错误，短信验证码' , 0);
                }else{
                    return $this->rt ( '', "发送成功，请注意接收短信", 1 );//($code)
                }
			}
		}
	}

    /**
    * 用户注册
    */
    public function reg($pdata, $session=true){
        $mobile = $pdata['mobile'];
        $code = $pdata['sms_code'];
        $password = $pdata['password'].'';
        $area_ids = $pdata['area_ids'].'';

        $truename = $pdata['truename'].'';
        $sex = $pdata['sex'].'';
        $company = $pdata['company'].'';
        $birthday = $pdata['birthday'].'';

        if(!$mobile){
            return array('data'=>null, 'info'=>'手机号不能为空', 'status'=>0);
        }/*else if(!$truename){
            return array('data'=>null, 'info'=>'姓名不能为空', 'status'=>0);
        }*/
        else if(!$password){
            return array('data'=>null, 'info'=>'密码不能为空', 'status'=>0);
        }else if(strlen($password)<6){
            return array('data'=>null, 'info'=>'密码长度不能小于6位', 'status'=>0);
        }
        else{
            $row = $this->where(array('mobile'=>$mobile))->find();
            if($row){
                return $this->rt ( '', '手机号已经被使用，请更换其它手机号', 0 );
            }

            $db_safecode = D('admin://Safecode');
            if(!$db_safecode->checkSafecode($mobile, $code)){
                return $this->rt ( '', '您输入的手机验证码不正确', 0 );
            }

            $password = $password? $password : '123456';
            
            $config = D('admin://Config')->getConfig('config');

            import('ORG.Util.String');
            $salt = String::randString(8);
            $data['area_ids'] = $area_ids;
            $data['salt'] = $salt;
            $data['password'] = $this->my_md5($password, $salt);
            $data['mobile'] = $mobile;
            $data['addtime'] = time();

            $data['truename'] = $truename;
            $data['sex'] = $sex;
            $data['company'] = $company;
            $data['branch'] = $pdata['branch'].'';
            $data['birthday'] = $birthday;

            $data['account'] = $config['level']['reg']*1;

            $regid = $this->add($data);
            //echo $this->getLastSql();exit;
            if($regid){
                //注册默认推送消息
                /*
                $t = time();
                $msgs = M('msg_pop')->where("type=1")->select();
                foreach($msgs as $item){
                    $msg = array('userid'=>$regid, 'title'=>$item["title"], 'content'=>$item["content"], 'addtime'=>$t);
                    M('msg')->add($msg);
                }
                */
                
                if($session){
                    $_SESSION['user'] = $regid;
                    return $this->rt ('', '', 1 );
                }else{
                    $token = D('admin://Auth')->getToken($regid, 1);
                    return $this->rt($token, '', 1);
                }
            }else{
                return $this->rt('', '', 1 );
            }
        }
    }

    /**
    * 用户登录
    */
    public function login($data, $session=true){
        $mobile = $data['mobile'];
        $password = $data['password'];
        $autologin = $data['autologin']*1;
        $_data = array();

        if(!$mobile){
            return $this->rt('', '手机号不能为空', 0 );
        }
        if(!$password){
            return $this->rt('', '密码不能为空', 0 );
        }
        $row = $this->where(array('mobile'=>$mobile))->find();
        
        if($row) {
            if($row['password'] != $this->my_md5($password, $row['salt'])) {
                return $this->rt('', '帐号或密码错误', 0 );
            }
            if($row['status']==0){
                return $this->rt('', '帐号已经被冻结', 0 );
            }

            $id = $row['id'];
            $_data['login_num'] = array('exp', 'login_num+1');
            $_data['lastlogin'] = time();     
            $this->where(array('id'=>$id))->save($_data);

            if($session){
                $_SESSION['user'] = $id;
                if($autologin){//记住登录
                    $token = D('admin://Auth')->getToken($id, 0);
                    cookie('token', $token, 3600*24*7);
                }
                return $this->rt('', '', 1);
            }else{
                $token = D('admin://Auth')->getToken($id, 1);
                return $this->rt (array('token'=>$token), '', 1 );
            }    
        }else {
            return $this->rt('', '帐号或密码错误', 0 );
        }
    }

    /**
    * 修改用户资料
    */
    public function updateUserinfo($id, $data){
        $_data = $data;
        
        $saveField = explode('|', "nickname|truename|sex|birthday|area_ids|street|company|branch");

        foreach($_data as $k=>$v){
            if(!in_array($k, $saveField)){
                unset($_data[$k]);
            }
        }

        $this->where(array('id'=>$id))->save($_data);
        

        return $this->rt( null, '', 1);
    }

    /**
    * 修改密码
    */
    public function changePwd($id, $data){
        $new_password = $data['new_password'];
        $old_password = $data['old_password'];
        $check = $data['check']===false? false : true;

        $row = $this->where(array('id'=>$id))->find();
        if(!$row){
            return $this->rt( null, '用户不存在', 0 );
        }
        if($check){
            if(!$new_password){
                return $this->rt( null, '请输入新密码', 0 );
            }
            if(!$old_password){
                return $this->rt( null, '请输入旧密码', 0 );
            }
            if($new_password == $old_password){
                return $this->rt( null, '新密码不能与旧密码相同', 0 );
            }
            if($row['password'] != $this->my_md5($old_password, $row['salt'])){
                return $this->rt( null, '旧密码不正确', 0 );
            }
        }

        import('ORG.Util.String');
        $salt = String::randString(8);
        $_data['salt'] = $salt;
        $_data['password'] = $this->my_md5($new_password, $salt);

        $this->where(array('id'=>$id))->save($_data);
        
        return $this->rt( null, '', 1);
    }

    /**
    * 获取注册手机验证码
    */
    public function getPwdMobilecode($account) {
		$account = $account;
		if (! $account || strlen($account)!=11 ) {
			return $this->rt ( '', '手机号不能为空或格式错误', 0 );
		} else {
            $row = $this->where(array('mobile'=>$account))->find();
            if(!$row){
                return $this->rt ( '', '手机号还没注册', 0 );
            }
            
            $db = D('admin://Safecode');
			$row = $db->where(array('account' => $account))->order('add_time DESC')->find();
			if ($row ['add_time'] > time () - 60) {
				return $this->rt ( '', '获取太频繁，获取时间间隔为1分钟', 0 );
			} else {
				$code = $db->getOneSafecode ( $account );
				// 发送注册duanxin
                $srt = $db->sendMsg($account, "尊敬的用户，您的操作验证码为".$code);
                if($srt['status']!=1){
                    //print_r($srt);exit;
                    //return $this->rt ( '', $srt['info'], 0);
                    return $this->rt ( '', '发送错误，短信验证码' , 0);
                }else{
                    return $this->rt ( '', "发送成功，请注意接收短信", 1 );//($code)
                }
			}
		}
	}

    /**
    * 找回密码
    */
    public function getpwd($pdata){
        $mobile = $pdata['mobile'];
        $code = $pdata['sms_code'];
        $password = $pdata['password'].'';

        if(!$mobile){
            return array('data'=>null, 'info'=>'手机号不能为空', 'status'=>0);
        }else if(!$code){
            return array('data'=>null, 'info'=>'请输入短信验证码', 'status'=>0);
        }
        else if(!$password){
            return array('data'=>null, 'info'=>'密码不能为空', 'status'=>0);
        }else if(strlen($password)<6){
            return array('data'=>null, 'info'=>'密码长度不能小于6位', 'status'=>0);
        }
        else{
            $row = $this->where(array('mobile'=>$mobile))->find();
            if(!$row){
                return $this->rt ( '', '不存在该手机号', 0 );
            }

            $db_safecode = D('admin://Safecode');
            if(!$db_safecode->checkSafecode($mobile, $code)){
                return $this->rt ( '', '您输入的手机验证码不正确', 0 );
            }

            import('ORG.Util.String');
            $salt = String::randString(8);
            $data['salt'] = $salt;
            $data['password'] = $this->my_md5($password, $salt);

            $db_rt = $this->where(array('id'=>$row['id']))->save($data);

            if($db_rt!==false){
                return $this->rt ('', '', 1 );
            }else{
                return $this->rt('', '修改失败', 0);
            }
        }
    }

    /**
    * 获取购物车中阿姨列表
    */
    public function getAppointmentCart($user){
        //fix
        $ids = array();
        $user['ext'] = json_decode($user['ext'],ture) ;
        if($user['ext']['appointment_hw_ids']){
            
            foreach($user['ext']['appointment_hw_ids'] as $hw_id){
                       $hw_row = M('houseworker')->where(array('id'=>$hw_id))->find();
                if($hw_row){
                    if(!in_array($hw_id, $ids))$ids[] = $hw_id;
                } 
            }
        }
        if($ids) $rows = M('houseworker')->where(array('id'=>array('in', $ids)))->select();
        $data = array();
        foreach($rows as $row){
            $data[] = $row;
        }

        return $data;
    }

    /**
    * 删除购物车中的阿姨
    */
    public function removeAppointmentCart($user, $p_hw_id){
        //fix
        $ids = array();
        $user['ext'] = json_decode($user['ext'],ture) ;
        if($user['ext']['appointment_hw_ids']){
            foreach($user['ext']['appointment_hw_ids'] as $k=>$hw_id){
                if($hw_id==$p_hw_id){
                    unset($user['ext']['appointment_hw_ids'][$k]);
                    M('member')->where(array('id'=>$user['id']))->save(array('ext'=>json_encode($user['ext'])));
                    return;
                }
            }

        }
    }
    
    
    
    
    /**
    * 获取购物车中阿姨列表
    */
    public function getAppointmentCartss($user,$idss){
        //fix
        $ids = array();
        $user['ext'] = json_decode($user['ext'],ture) ;
        if($user['ext']['appointment_hw_ids']){
            
            foreach($user['ext']['appointment_hw_ids'] as $hw_id){
                
                foreach($idss as $vs){
                    if($hw_id == $vs){
                       $hw_row = M('houseworker')->where(array('id'=>$hw_id))->find();
                if($hw_row){
                    if(!in_array($hw_id, $ids))$ids[] = $hw_id;
                } 
                    }
                }  
            }
        }
        if($ids) $rows = M('houseworker')->where(array('id'=>array('in', $ids)))->select();
        $data = array();
        foreach($rows as $row){
            $data[] = $row;
        }

        return $data;
    }

 
    
    
/**
    * 加入预约购物车
    */
    public function addAppointmentCart($user, $pdata){
        $p_hw_id = $pdata['hw_id'];
        if(!$p_hw_id){
            return $this->rt('', '请传入阿姨ID', 0);
        }

        //fix
        $ids = array();
        $user['ext'] = json_decode($user['ext'],true) ;
        if($user['ext']['appointment_hw_ids']){
            foreach($user['ext']['appointment_hw_ids'] as $hw_id){
                
                $hw_row = M('houseworker')->where(array('id'=>$hw_id))->find();
                if($hw_row){
                    if(!in_array($hw_id, $ids))$ids[] = $hw_id;
                }
            }
        }
        if(count($ids)>=5){
            return $this->rt('', '超过5个，无法继续添加', 0);
        }

        if(!in_array($p_hw_id, $ids)){
            $ids[] = $p_hw_id;
            $ext = $user['ext'];
            $ext['appointment_hw_ids'] = $ids;
            M('member')->where(array('id'=>$user['id']))->save(array('ext'=>json_encode($ext)));
        }else{
            return $this->rt('', '已经添加过，无需重复添加', 0);
        }

        return $this->rt('', '', 1);
    }


    /**
    * 预约
    */
    public function addAppointment($user, $pdata){
        $db = M('appointment');
        $user['ext'] = json_decode($user['ext'],true);
        $data['u_id'] = $user['id'];
        $p_hw_ids = $pdata['hw_ids']? explode(',', $pdata['hw_ids']) : array();
        $p_hw_ids = $p_hw_ids? $p_hw_ids : $user['ext']['appointment_hw_ids'];

        $data['plan_date'] = strtotime($pdata['plan_date']);
        $data['username'] = $pdata['username'].'';
        $data['tel'] = $pdata['tel'].'';
        $data['memo'] = $pdata['memo'].'';

        $data['meet_type'] = $pdata['meet_type'].'';
        $data['address'] = $pdata['address'].'';
        $data['street'] = $pdata['street'].'';

        if(!$p_hw_ids){
            return $this->rt('', '请指定阿姨ID', 0);
        }
        if(count($p_hw_ids)>5){
            return $this->rt('', '单次预约阿姨数量不能超过5个', 0);
        }

        foreach($p_hw_ids as $hw_id){
            $hw_id = $hw_id*1;
            $hw_row = M('houseworker')->where(array('id'=>$hw_id))->find();
            if(!$hw_row){
                return $this->rt('', '阿姨ID有误', 0);
            }
            $data['hwtype_id'] = $hw_row['hwtype_id'];
        }

        if(!$pdata['plan_date']){
            return $this->rt('', '请输入预约日期', 0);
        }
        if($data['plan_date']===false){
            return $this->rt('', '预约日期格式有误', 0);
        }

        list($y, $m, $d) = explode('-', date('Y-m-d', $data['plan_date']));
        list($yy, $mm, $dd) = explode('-', date('Y-m-d'));
        if(mktime(0,0,0,$m,$d,$y) <= mktime(0,0,0,$mm,$dd,$yy)){
            return $this->rt('', '预约日期只能是今天之后', 0);
        }

        if(!$data['username']){
            return $this->rt('', '请输入联系姓名', 0);
        }
        if(!$data['tel']){
            return $this->rt('', '请输入联系电话', 0);
        }
        
        //判断是否预约过
        foreach($p_hw_ids as $hw_id){
            $hw_id = $hw_id*1;
            if($db->where(array('u_id'=>$data['u_id'], 'plan_date'=>$data['plan_date'], "CONCAT(',',hw_ids,',') LIKE ',". $hw_id .",'"))->count()>0){
                return $this->rt('', '有部分阿姨已经预约过，不需重复预约', 0);
            }
        }

        $data['add_time'] = time();
        $data['hw_ids'] = implode(',', $p_hw_ids);
        $db->add($data);

        $ext = $user['ext'];
        $array = array();
        foreach($ext['appointment_hw_ids'] as $vd){
            foreach($p_hw_ids as $gd){
                if($vd != $gd){
                    $array []= $vd ;
                }
            }
        }
        $ext['appointment_hw_ids'] = $array ;
        
        M('member')->where(array('id'=>$user['id']))->save(array('ext'=>json_encode($ext)));

        return $this->rt('', '', 1);
    }

    /**
    * 我的阿姨
    */
    public function myAppointments($user, $pdata){
        $uid = $user['id'];
        $db_pre = C('DB_PREFIX');
        $db = M('appointment');

        $pagesize = $pdata['pagesize']? $pdata['pagesize']*1 : 20;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $pdata['page']? $pdata['page']*1 : 1;

        //$type = $_REQUEST['type']*1;
        
        $condition = array();
        
        $field = "{$db_pre}appointment.*";

        $condition = "1=1";
        $condition .= " AND u_id='{$uid}'";

        if($pdata['type']=='SIGNED'){//已经签约
            $condition .= " AND {$db_pre}appointment.status>0 AND hw_id>0";
        }else if($pdata['type']=='APPLY'){//预约
            $condition .= " AND {$db_pre}appointment.status>=0 AND hw_id=0";
        }
        if($pdata['hwtype_id']>0){//类型
            $condition .= " AND {$db_pre}appointment.hwtype_id = '". $pdata['hwtype_id'] ."'";
        }

        $count = $db->field($field)->join($join)->where($condition)->count();

        $rows = $db->field($field)->join($join)->order("{$db_pre}appointment.plan_date DESC, {$db_pre}appointment.id DESC")->where($condition)->limit($pagesize)->page($page)->select();
        //echo $db->getLastSql();exit;
        $rows = $rows? $rows : "";

        $data['page'] = $page;
        $data['count'] = $count;
        $data['page_count'] = ceil($count/$pagesize);     

        return array('page'=>$data['page'], 'count'=>$data['count'], 'pagesize'=>$data['pagesize'], 'page_count'=>$data['page_count'], 'list'=>$rows);
    }

    /**
    * 上传销售记录
    */
    public function addSellLog($user, $pdata){
        $config = D('admin://Config')->getConfig('config');
        
        if($pdata['qty']*1<=0){
            return $this->rt( null, '请输入销售数量', 0 );
        }

        if($pdata['addtime'].''===''){
            return $this->rt( null, '请输入销售日期', 0 );
        }

        //print_r($user);exit;
        if($user){
            if($user['ext']['sellpic'].''===''){
                return $this->rt( null, '请上传销售小票', 0 );
            }else{
                $sellpic = $user['ext']['sellpic'];
            }
        }else{
            if($pdata['sellpic'].''===''){
                return $this->rt( null, '请上传销售小票', 0 );
            }else{
                $sellpic = $pdata['sellpic'];
            }
        }        
        
        $data['qty'] = $pdata['qty']*1;
        $data['addtime'] = strtotime($pdata['addtime']);
        $data['pic'] = $sellpic;

        $data['user_id'] = $user['id']*1;

        $add_id = M('sell_log')->add($data);

        $earn = $config['level']['earn']*1;
        $earn = $earn<=0? 1 : $earn;
        $earn = $earn*$data['qty'];

        unset($user['ext']['sellpic']);
        $this->where(array('id'=>$user['id']))->save(array('ext'=>json_encode($user['ext'])));
        if($user){
            M('member')->where(array('id'=>$user['id']))->save(array('account'=>array('exp', 'account+'. $earn)));
        }

        //流水记录
        M('account_log')->add(array('userid'=>$user['id']*1, 'type'=>0, 'sell_log_id'=>$add_id, 'qty'=>$pdata['qty']*1, 'total'=>$earn, 'log_time'=>$data['addtime'], 'addtime'=>time()));

        return $this->rt('', '', 1);
    }

    /**
    * 销售记录列表
    */
    public function getSellLogList($userid, $data){
        $pagesize = $data['pagesize']? $data['pagesize']*1 : 20;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $data['page']? $data['page']*1 : 1;
        
        $condition = array();
        
        $db_pre = C('DB_PREFIX');
        $db = M('sell_log');

        $condition = array();
        $condition['user_id'] = $userid;
        //$condition['status'] = 1;

        $tmp_t = strtotime($data['start_date']);
        if($tmp_t!==false){
            $min_time = $tmp_t;
        }

        $tmp_t = strtotime($data['end_date']);
        if($tmp_t!==false){
            $max_time = $tmp_t+3600*24;
        }

        if($min_time){
            $condition[] = "addtime>='{$min_time}'";
        }
        if($max_time){
            $condition[] = "addtime<'{$max_time}'";
        }

        $count = $db->where($condition)->count();

        $rows = $db->order("addtime DESC")->where($condition)->limit($pagesize)->page($page)->select();
        $rows = $rows? $rows : array();      

        $data['page'] = $page;
        $data['count'] = $count;
        $data['page_count'] = ceil($count/$pagesize);
        $data['list'] = $rows;

        return $data;
    }

    /**
    * 兑换列表
    */
    public function getEgoodsList($data){
        $pagesize = $data['pagesize']? $data['pagesize']*1 : 20;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $data['page']? $data['page']*1 : 1;
        
        $condition = array();
        
        $db_pre = C('DB_PREFIX');
        $db = M('egoods');

        $condition = array();
        $condition['status'] = 1;

        $count = $db->where($condition)->count();

        $rows = $db->order("`sort` ASC")->where($condition)->limit($pagesize)->page($page)->select();
        $rows = $rows? $rows : array();      

        $data['page'] = $page;
        $data['count'] = $count;
        $data['page_count'] = ceil($count/$pagesize);
        $data['list'] = $rows;

        return $data;
    }

    /**
    * 兑换
    */
    public function addExchange($user, $pdata){
        if($pdata['qty']*1<=0){
            return $this->rt( null, '请输入兑换数量', 0 );
        }
        if($pdata['eid']*1<=0){
            return $this->rt( null, '商品ID不能为空', 0 );
        }

        $egoods = M('egoods')->where(array('id'=>$pdata['eid']))->find();
        if(!$egoods){
            return $this->rt( null, '商品ID有误', 0 );
        }
        if($egoods['status']!=1){
            return $this->rt( null, '商品已经下架', 0 );
        }

        $total = $pdata['qty']*$egoods['price'];
        if($total>$user['account']){
            return $this->rt( null, '账户余额不足', 0 );
        }
        
        $data['eid'] = $pdata['eid'];
        $data['qty'] = $pdata['qty']*1;
        $data['price'] = $egoods['price'];
        $data['addtime'] = time();

        $data['user_id'] = $user['id'];

        M('exchange')->add($data);
        M('member')->where(array('id'=>$user['id']))->save(array('account'=>array('exp', 'account-' . $total)));

        $egoods = M('egoods')->where(array('id'=>$pdata['eid']))->find();

        //兑换通知，仅通知最近一级的代理
        if($user['area_ids']){
            $t = time();
            $sellers = M('area')->where("seller_id>0 AND id IN(". $user['area_ids'] .")")->order('id DESC')->select();
            foreach($sellers as $item){
                $msg_bd = '您好，您的客户在'. $user['branch'] .'连锁'. $user['company'] .'门店，手机号：'. $user['mobile'] .'，于'. date('Y年m月d日H时') .'兑换礼品'. $egoods['title'] .'，'. $data['qty'] .'个，请及时送货';
                $msg = array('userid'=>$item['seller_id'], 'title'=>'会员ID【'. $user['id'] .'】兑换通知', 'content'=>$msg_bd, 'addtime'=>$t);
                M('msg')->add($msg);

                //发送短信
                $row_seller = M('member')->where(array('id'=>$item['seller_id']))->find();
                D('admin://Safecode')->sendMsg($row_seller['mobile'], $msg_bd);

                break;
            }
        }


        unset($user['ext']['sellpic']);
        $this->where(array('id'=>$user['id']))->save(array('ext'=>json_encode($user['ext'])));

        return $this->rt('', '', 1);
    }

    /**
    * 我的兑换列表
    */
    public function getMyExchanges($userid, $data){
        $pagesize = $data['pagesize']? $data['pagesize']*1 : 20;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $data['page']? $data['page']*1 : 1;
        
        $condition = array();
        
        $db_pre = C('DB_PREFIX');
        $db = M('exchange');

        $condition = array();
        $condition['user_id'] = $userid;

        $field = "{$db_pre}exchange.*, {$db_pre}egoods.title, {$db_pre}egoods.desc, {$db_pre}egoods.thumbs";
        $join = "{$db_pre}egoods ON {$db_pre}egoods.id = eid";
        //$condition['status'] = 1;

        $count = $db->field($field)->join($join)->where($condition)->count();

        $rows = $db->field($field)->join($join)->order("{$db_pre}exchange.addtime DESC")->where($condition)->limit($pagesize)->page($page)->select();
        //echo $db->getLastSql();exit;
        $rows = $rows? $rows : array();      

        $data['page'] = $page;
        $data['count'] = $count;
        $data['page_count'] = ceil($count/$pagesize);
        $data['list'] = $rows;

        return $data;
    }


    /**
    * 文章列表
    */
    public function getArtList($data){
        $pagesize = $data['pagesize']? $data['pagesize']*1 : 20;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $data['page']? $data['page']*1 : 1;
        
        $condition = array();
        
        $db_pre = C('DB_PREFIX');
        $db = M('siteinfo');

        $condition = array();
        $condition["{$db_pre}siteinfo.is_display"] = 1;
        if($data['pos']){
            $condition["{$db_pre}siteinfo_type.position"] = $data['pos'];
        }

        $field = "{$db_pre}siteinfo.*";
        $join = "{$db_pre}siteinfo_type ON {$db_pre}siteinfo_type.id={$db_pre}siteinfo.typeid";
        //$condition['status'] = 1;

        $count = $db->field($field)->join($join)->where($condition)->count();

        $rows = $db->field($field)->order("{$db_pre}siteinfo.is_top DESC, {$db_pre}siteinfo.sort ASC")->join($join)->where($condition)->limit($pagesize)->page($page)->select();
        $rows = $rows? $rows : array();      

        $data['page'] = $page;
        $data['count'] = $count;
        $data['page_count'] = ceil($count/$pagesize);
        $data['list'] = $rows;

        return $data;
    }

    /**
    * 消息列表
    */
    public function getMsgList($userid, $data){
        $pagesize = $data['pagesize']? $data['pagesize']*1 : 20;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $data['page']? $data['page']*1 : 1;
        
        $condition = array();
        
        $db_pre = C('DB_PREFIX');
        $db = M('msg');

        $condition = array();
        $condition['userid'] = $userid;


        $count = $db->where($condition)->count();

        $rows = $db->order("id DESC")->where($condition)->limit($pagesize)->page($page)->select();
        //echo $db->getLastSql();exit;
        $rows = $rows? $rows : array();      

        $data['page'] = $page;
        $data['count'] = $count;
        $data['page_count'] = ceil($count/$pagesize);
        $data['list'] = $rows;

        return $data;
    }


    /**
    * 发布通知
    */
    public function sendMqttMsg($target, $msg){
        require_once('SAM/php_sam.php');
        $conn = new SAMConnection();

        //start initialise the connection
        $conn->connect(SAM_MQTT, array(SAM_HOST => '127.0.0.1', //'127.0.0.1',
                                       SAM_PORT => 1883));      
        //create a new MQTT message with the output of the shell command as the body
        $msg = is_array($msg)? json_encode($msg) : $msg;
        $msgCpu = new SAMMessage($msg);

        //send the message on the topic cpu
        $conn->send('topic://app_gsk/'.$target, $msgCpu);
        
        $this->logSend($target, $msg);
        
        $conn->disconnect();         
    }

    /**
    * 记录
    */
    private function logSend($target, $msg){
        error_log(date('Y-m-d H:i:s') . "\nUA: " . $_SERVER['HTTP_USER_AGENT'] . "\n" . "Target:". $target . "\nMsg:". $msg . "\n", 3, 'cron.log');
    }
    
    public function p(){
        echo '数据库连接成功' ;
    }
}
