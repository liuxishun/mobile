<?php
class BaseAction extends Action{
    public function _initialize(){
        $this->config = D('admin://Config')->getConfig();
        $this->assign('config', $this->config);

        $root = __ROOT__;
        $root = $root=='/'? $root : $root.'/';
        $this->assign('_root', $root);    
        
        //传入公共模型对象
        $this->common = D('Common');
        $this->assign('common', $this->common);

		//自动登录
        $this->autologin();

        //上传是SESSION回传
        if(!$_SESSION['user'] && $_REQUEST["agent"]){
            session_id($_REQUEST["agent"]);
        }
	  	
        //登陆用户信息
        if($_SESSION['user']){
            $this->userid = $_SESSION['user'];

            $user = M('member')->where(array('id'=>$loginid))->find();
            $ext = json_decode($user['ext'], true);
            $user['ext'] = is_array($ext)? $ext : array();
            $this->user = $user;
        }

        // 用户权限检查
	  	$this->check_priv();
    }

    /**
    * 权限检查
    */
    public function check_priv(){
        if(MODULE_NAME=='Member' || MODULE_NAME=='User'){
            if(!$this->userid && !$this->user){
                redirect(__APP__ . "/Index/login");
                exit;
            }
        }
    }

    /**
    * 自动登录
    */
    public function autologin(){
        $token = cookie('token');
        if(!$_SESSION['user'] && cookie('token')){
            $row = D('admin://Auth')->getLoginid($token);
            if($row){
                $_SESSION['user'] = $row['id'];
            }else{
                cookie('token', null);
            }
        }
    }
    
    //示远营销短信推送
    public function marketingMsg($mobile, $msg){
    	$mobile = trim($mobile);
    	if(!$mobile || strlen($mobile)>11){
    		echo 0;
    	}
    	//$msg = iconv('UTF-8', 'GBK', $msg);
    	$msg = urlencode($msg);//发送内容
    	$target = "http://121.43.107.8:8888/sms.aspx?action=send&userid=399&account=6WP073&password=SmQ01KWf&mobile=$mobile&content=$msg&sendTime=&extno=";
    	$ret = trim(file_get_contents($target));
    	if(strpos($ret, '<message>ok</message>')!==false){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
    
    //示运短信推送
    public function yuanMsg($mobile, $msg){
    	$mobile = trim($mobile);
    	if(!$mobile || strlen($mobile)>11){
    		return 0;
    	}
    	//$msg = iconv('UTF-8', 'GBK', $msg);
    	$msg = urlencode($msg);//发送内容
    	$target = "http://send.18sms.com/msg/HttpBatchSendSM?account=30fv2g&pswd=hxJUKC10&mobile={$mobile}&msg={$msg}&needstatus=true&product=";
    	$ret = trim(file_get_contents($target));
    	//echo $ret;
    	if(strpos($ret, ',0')!==false){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    /**
    * 补全资源地址链接
    */
    public function fullAssetsUrl($src){
        return $src? (strpos(strtolower($src), 'http')!==false? $src : 'http://'. $_SERVER['HTTP_HOST'] .'/'. __ROOT__ . '/' . $src) : '';
    }

    /**
    * 输出json编码
    */
    public function ajaxRt(){
        header('Content-Type:text/html; Charset=UTF-8');
        if(func_num_args()==1){
            $arr = func_get_arg(0);
        }else{
            $arr = array('data'=>func_get_arg(0), 'info'=>func_get_arg(1), 'status'=>func_get_arg(2));
        }
        echo json_encode($arr);
        exit;
    }
	  
	//去除转义方法
    /*public function mystrip(&$data){
        if (is_array($data)){
            foreach ($data as &$v){
                $this->mystrip($v);
            }
        }else{
            $data = stripslashes($data);
        }
    }*/
    
    //用户表password字段的加密算法
    protected function my_md5($psw, $salt){
        return md5($salt.md5($psw.'think').$salt);
    }
	 
	protected function error($message, $url_forward='javascript:history.go(-1);',$ms = 3,$ajax=false)
	{
		$this->jumpUrl = $url_forward;
		$this->waitSecond = $ms;
		parent::error($message, $ajax);
	}

	protected function success($message, $url_forward='',$ms = 3,$ajax=false)
	{
		$this->jumpUrl = $url_forward;
		$this->waitSecond = $ms;
		parent::success($message, $ajax);
	}

    //编辑页的成功返回
    protected function success2($message, $url_forward='',$ms = 3,$ajax=false)
	{
		$this->jumpUrl = $this->listurl? $this->listurl : $url_forward;
		$this->waitSecond = $ms;
		parent::success($message, $ajax);
	}

    //删除目录
    protected function delFile($dir){
        if(file_exists($dir)){
            $dir_handle = opendir($dir);
            while($filename = readdir($dir_handle)){
                if($filename == "." || $filename == ".."){
                    continue;
                }
                $subfile = $dir."/".$filename;

                if(is_dir($subfile)){

                    $this->delFile($subfile);
                
                }else{
                
                    unlink($subfile);
                }
            }
            closedir($dir_handle);
            rmdir($dir);
        }
    }

    /**
    * KindEditor编辑器文件空间预览
    */
    public function file_manager_json(){
        $php_path = '';
        $php_url = dirname($_SERVER['PHP_SELF']) . '/';
        $php_url = str_replace('//', '/', $php_url);

        //根目录路径，可以指定绝对路径，比如 /var/www/attached/
        $root_path = $php_path . 'public/uploads/';
        //根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
        $root_url = $php_url . 'public/uploads/';
        //图片扩展名
        $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

        //目录名
        $dir_name = empty($_GET['dir']) ? '' : trim($_GET['dir']);
        if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file'))) {
            echo "Invalid Directory name.";
            exit;
        }
        if ($dir_name !== '') {
            $root_path .= $dir_name . "/";
            $root_url .= $dir_name . "/";
            if (!file_exists($root_path)) {
                mkdir($root_path, 0777, true);
            }
        }

        //根据path参数，设置各路径和URL
        if (empty($_GET['path'])) {
            $current_path = realpath($root_path) . '/';
            $current_url = $root_url;
            $current_dir_path = '';
            $moveup_dir_path = '';
        } else {
            $current_path = realpath($root_path) . '/' . $_GET['path'];
            $current_url = $root_url . $_GET['path'];
            $current_dir_path = $_GET['path'];
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }
        //排序形式，name or size or type
        $order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

        //不允许使用..移动到上一级目录
        if (preg_match('/\.\./', $current_path)) {
            echo 'Access is not allowed.';
            exit;
        }
        //最后一个字符不是/
        if (!preg_match('/\/$/', $current_path)) {
            echo 'Parameter is not valid.';
            exit;
        }
        //目录不存在或不是目录
        if (!file_exists($current_path) || !is_dir($current_path)) {
            echo 'Directory does not exist.';
            exit;
        }

        //遍历目录取得文件信息
        $file_list = array();
        if ($handle = opendir($current_path)) {
            $i = 0;
            while (false !== ($filename = readdir($handle))) {
                if ($filename{0} == '.') continue;
                $file = $current_path . $filename;
                if (is_dir($file)) {
                    $file_list[$i]['is_dir'] = true; //是否文件夹
                    $file_list[$i]['has_file'] = (count(scandir($file)) > 2); //文件夹是否包含文件
                    $file_list[$i]['filesize'] = 0; //文件大小
                    $file_list[$i]['is_photo'] = false; //是否图片
                    $file_list[$i]['filetype'] = ''; //文件类别，用扩展名判断
                } else {
                    $file_list[$i]['is_dir'] = false;
                    $file_list[$i]['has_file'] = false;
                    $file_list[$i]['filesize'] = filesize($file);
                    $file_list[$i]['dir_path'] = '';
                    $file_ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $file_list[$i]['is_photo'] = in_array($file_ext, $ext_arr);
                    $file_list[$i]['filetype'] = $file_ext;
                }
                $file_list[$i]['filename'] = $filename; //文件名，包含扩展名
                $file_list[$i]['datetime'] = date('Y-m-d H:i:s', filemtime($file)); //文件最后修改时间
                $i++;
            }
            closedir($handle);
        }

        //排序
        function cmp_func($a, $b) {
            global $order;
            if ($a['is_dir'] && !$b['is_dir']) {
                return -1;
            } else if (!$a['is_dir'] && $b['is_dir']) {
                return 1;
            } else {
                if ($order == 'size') {
                    if ($a['filesize'] > $b['filesize']) {
                        return 1;
                    } else if ($a['filesize'] < $b['filesize']) {
                        return -1;
                    } else {
                        return 0;
                    }
                } else if ($order == 'type') {
                    return strcmp($a['filetype'], $b['filetype']);
                } else {
                    return strcmp($a['filename'], $b['filename']);
                }
            }
        }
        usort($file_list, 'cmp_func');

        $result = array();
        //相对于根目录的上一级目录
        $result['moveup_dir_path'] = $moveup_dir_path;
        //相对于根目录的当前目录
        $result['current_dir_path'] = $current_dir_path;
        //当前目录的URL
        $result['current_url'] = $current_url;
        //文件数
        $result['total_count'] = count($file_list);
        //文件列表数组
        $result['file_list'] = $file_list;

        //输出JSON字符串
        header('Content-type: application/json; charset=UTF-8');
        echo json_encode($result);
    }

    /**
    * KindEditor编辑器上传文件
    */
    public function upload_json(){
        $php_path = '';
        $php_url = dirname($_SERVER['PHP_SELF']) . '/';
        $php_url = str_replace('//', '/', $php_url);

        //文件保存目录路径
        $save_path = $php_path . 'public/uploads/';
        //文件保存目录URL
        $save_url = $php_url . 'public/uploads/';
        //定义允许上传的文件扩展名
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
        );
        //最大文件大小
        $max_size = 1*1000*1000;

        $save_path = realpath($save_path) . '/';

        //PHP上传失败
        if (!empty($_FILES['imgFile']['error'])) {
            switch($_FILES['imgFile']['error']){
                case '1':
                    $error = '超过php.ini允许的大小。';
                    break;
                case '2':
                    $error = '超过表单允许的大小。';
                    break;
                case '3':
                    $error = '图片只有部分被上传。';
                    break;
                case '4':
                    $error = '请选择图片。';
                    break;
                case '6':
                    $error = '找不到临时目录。';
                    break;
                case '7':
                    $error = '写文件到硬盘出错。';
                    break;
                case '8':
                    $error = 'File upload stopped by extension。';
                    break;
                case '999':
                default:
                    $error = '未知错误。';
            }
            alert($error);
        }

        //有上传文件时
        if (empty($_FILES) === false) {
            //原文件名
            $file_name = $_FILES['imgFile']['name'];
            //服务器上临时文件名
            $tmp_name = $_FILES['imgFile']['tmp_name'];
            //文件大小
            $file_size = $_FILES['imgFile']['size'];
            //检查文件名
            if (!$file_name) {
                alert("请选择文件。");
            }
            //检查目录
            if (@is_dir($save_path) === false) {
                alert("上传目录不存在。");
            }
            //检查目录写权限
            if (@is_writable($save_path) === false) {
                alert("上传目录没有写权限。");
            }
            //检查是否已上传
            if (@is_uploaded_file($tmp_name) === false) {
                alert("上传失败。");
            }
            //检查文件大小
            if ($file_size > $max_size) {
                alert("上传文件大小超过限制。");
            }
            //检查目录名
            $dir_name = empty($_GET['dir']) ? 'image' : trim($_GET['dir']);
            if (empty($ext_arr[$dir_name])) {
                alert("目录名不正确。");
            }
            //获得文件扩展名
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            //检查扩展名
            if (in_array($file_ext, $ext_arr[$dir_name]) === false) {
                alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
            }
            //创建文件夹
            if ($dir_name !== '') {
                $save_path .= $dir_name . "/";
                $save_url .= $dir_name . "/";
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }
            }
            $ymd = date("Ym");
            $save_path .= $ymd . "/";
            $save_url .= $ymd . "/";
            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }
            //新文件名
            $new_file_name = date("YmdHis") . '_' . mt_rand(10000, 99999) . '.' . $file_ext;
            //移动文件
            $file_path = $save_path . $new_file_name;
            if (move_uploaded_file($tmp_name, $file_path) === false) {
                alert("上传文件失败。");
            }
            @chmod($file_path, 0644);
            $file_url = $save_url . $new_file_name;

            header('Content-type: text/html; charset=UTF-8');
            echo json_encode(array('error' => 0, 'url' => $file_url));
            exit;
        }
    }

    /**
    $isthumb: 默认值未false,true 生产缩略图，
    $width: 缩略图的最大宽度,默认值:400，
    $height: 缩略图的最大高度,默认值:300
    */
    protected function _uploadpic($folder, $isthumb=true, $width=800, $height=600, $isforce_cut=0, $extend='')
    {
        $userid = $this->member['id'];
        //$folder = $_GET['folder'];
        $folder = str_replace('..', '', $folder);
        $folder = $folder? $folder.'/' : '';

        import("ORG.Net.UploadFile");
        //include APP_PATH.'Common/dir.func.php';
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize = 1024*1024; //1M
        $upload->allowExts = explode(',', $extend? $extend : 'jpg,gif,png,jpeg');
        $upload->savePath = "Public/uploads/userfiles/". ceil($userid/1000) . '/' .  $folder ; //. date('Ym/')

        $upload->thumb = false;
        $upload->thumbMaxWidth=$width;
        $upload->thumbMaxHeight=$height;


        $upload->saveRule='uniqid';
        if(!file_exists($upload->savePath)){
            $dir_result = mkdir($upload->savePath, 0777, true);
            if(!$dir_result){return array('status'=>0, 'info'=>'目录创建失败');}
        }
        if (!$upload->upload()) {
            //捕获上传异常
            return array('status'=>0, 'info'=>$upload->getErrorMsg());
        } else {
            //取得成功上传的文件信息
            $uploadList = $upload->getUploadFileInfo();
        }
        foreach($uploadList as $k=>$v){
            $file_path = $upload->savePath.$uploadList[$k]['savename'];
            $uploadList[$k]['savename'] = $file_path;
            //裁剪图片
            if($isthumb && $width>0 && $height>0){
                import('ORG.Util.Image');
                if($isforce_cut){
                    Image::thumb2($file_path, $file_path, '', $width, $height); //强制裁剪尺寸，多余被裁掉
                }else{
                    Image::thumb($file_path, $file_path, '', $width, $height);
                }
            }
        }
        return array('data'=>$uploadList, 'status'=>1, 'info'=>'');
    }

    /**
    * 上传头像(投资方用户)
    */
    public function uploadface(){
        $userid = $this->user['id']*1 + $_SESSION['regid']*1;
        $callback = $_GET['callback'];
        $callback = $callback? $callback : 'uploadSuccess';
        $result = $this->_uploadpic('face', true, 100, 100, 1);
        if($result['status']==1){
            //删除原头像
            @unlink($this->user['face']);
            
            $item = reset($result['data']);
            M('usercmp_data')->where(array('userid'=>$userid))->save(array('face'=>$item['savename']));
        }

        header('Content-type: text/html; charset=UTF-8');
        echo "<script>var _upfn = window.parent.{$callback};_upfn?_upfn(". json_encode($result) ."):console.log(". json_encode($result) .");</script>";
    }

    /**
    * 上传个人资料证明
    */
    public function uploadinfo(){
        $userid = $this->user['id']*1 + $_SESSION['regid']*1;
        $callback = $_GET['callback'];
        $callback = $callback? $callback : 'uploadSuccess';
        $result = $this->_uploadpic('info', true, 1000, 1000, 0, 'jpg,gif,png,jpeg,doc,docx,pdf');
        if($result['status']==1){
            //删除原头像
            @unlink($this->user['infopic']);
            
            $item = reset($result['data']);
            M('usercmp_data')->where(array('userid'=>$userid))->save(array('infopic'=>$item['savename']));
        }

        header('Content-type: text/html; charset=UTF-8');
        echo "<script>var _upfn = window.parent.{$callback};_upfn?_upfn(". json_encode($result) ."):console.log(". json_encode($result) .");</script>";
    }

    /**
    * 上传投资证明
    */
    public function uploadcase(){
        $userid = $this->user['id']*1 + $_SESSION['regid']*1;
        $callback = $_GET['callback'];
        $callback = $callback? $callback : 'uploadSuccess';
        $result = $this->_uploadpic('case', true, 1000, 1000, 0, 'jpg,gif,png,jpeg,doc,docx,pdf');
        if($result['status']==1){
            //删除原头像
            @unlink($this->user['casepic']);
            
            $item = reset($result['data']);
            M('usercmp_data')->where(array('userid'=>$userid))->save(array('casepic'=>$item['savename']));
        }

        header('Content-type: text/html; charset=UTF-8');
        echo "<script>var _upfn = window.parent.{$callback};_upfn?_upfn(". json_encode($result) ."):console.log(". json_encode($result) .");</script>";
    }

}