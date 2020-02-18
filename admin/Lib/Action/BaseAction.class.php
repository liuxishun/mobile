<?php
class BaseAction extends Action{
    public function _initialize(){
		// 用户权限检查
	  	$this->check_priv();

	  	//去除转义 不用系统的自动转义
	  	if (get_magic_quotes_gpc()) {
			$this->mystrip($_POST);
			$this->mystrip($_GET);
		}

		
	  	//登陆用户信息
		$this->admin_id = $_SESSION[C('MY_AUTH_KEY')]; //与 $this->assign('admin_id', $_SESSION[C('MY_AUTH_KEY')]); 等价
        $this->admin = M('admin')->where(array('id'=>$this->admin_id))->find();

        //记录列表页传过来的url或从编辑页提交的url
        //echo $this->_get('listurl');exit;
        $this->listurl = strip_tags(urldecode(base64_decode($this->_request('listurl'))));
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

    //检查权限
    public function check_priv()
    {
        if(!$_SESSION['admin_id'] && $_REQUEST["PHPSESSID"]){
            session_id($_REQUEST["PHPSESSID"]);
        }
        if (!$_SESSION['admin_id'] && MODULE_NAME != 'Public') {
            //$this->error('没有登录或登录超时', '__APP__/Public/login');
            $this->redirect('__APP__/Public/login');
        }else{
            // 用户权限检查
            import('ORG.Util.MyRBAC');
            if (!MyRBAC::AccessDecision()) {
                //检查认证识别号
                $this->error('您无权限进行该操作');
            }
        }
    }
	  
	//去除转义方法
    public function mystrip($data){
        if (is_array($data)){
            foreach ($data as $v){
                $this->mystrip($v);
            }
        }else{
            $data = stripslashes($data);
        }
    }

    /**
    $isthumb: 默认值未false,true 生产缩略图，
    $width: 缩略图的最大宽度,默认值:400，
    $height: 缩略图的最大高度,默认值:300
    */
    private function _uploadpic($folder, $isthumb=false, $width="400", $height='300')
    {
        $userid = $this->member['id'];
        //$folder = $_GET['folder'];
        $folder = str_replace('..', '', $folder);
        $folder = $folder? $folder.'/' : '';

        import("ORG.Net.UploadFile");
        include APP_PATH.'Common/dir.func.php';
        $upload = new UploadFile();
        //设置上传文件大小
        $upload->maxSize = 1024*1024; //1M
        $upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
        $upload->savePath = "Public/uploads/userfiles/". ceil($userid/1000) . '/' .  $folder ; //. date('Ym/')

        $upload->thumb = $isthumb;
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
           $uploadList[$k]['savename'] = $upload->savePath.$uploadList[$k]['savename'];
        }
        return array('data'=>$uploadList, 'status'=>1, 'info'=>'');
    }

    /**
    * 用户上传图片
    */
    /*public function uploadpic(){
        $folder = $_GET['folder'];
        $callback = $_GET['callback'];
        $callback = $callback? $callback : 'uploadSuccess';
        $result = $this->_uploadpic($folder);
        header('Content-type: text/html; charset=UTF-8');
        
        echo "<script>var _upfn = window.parent.{$callback};_upfn?_upfn(". json_encode($result) ."):console.log(". json_encode($result) .");</script>";
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
    * 文件空间控件
    */
    public function folder_manager_json(){
        $root_path = $php_path . 'Public/uploads/';
        $act = empty($_GET['act']) ? '' : trim($_GET['act']);
        $dir = empty($_GET['dir']) ? '' : trim($_GET['dir']);
        $path = empty($_GET['path']) ? '' : trim($_GET['path']);
        $filename = empty($_GET['filename']) ? '' : trim($_GET['filename']);
        $dir = str_replace('..', '', $dir);
        $path = str_replace('..', '', $path);
        $filename = str_replace('..', '', $filename);

        if($act=='create'){
            $root_path .= $dir . "/" . $path;
            if (!file_exists($root_path)) {
                @mkdir($root_path, 0777, true);
            }
        }else if($act=='delete' && ($dir || $path || $filename)){
            $del_path = $root_path . $dir . "/" . $path . '/' . $filename;

            if(is_dir($del_path) && pathinfo($del_path)!=pathinfo($root_path) && file_exists($del_path)){
                $this->delFile($del_path);
            }else if(file_exists($del_path)){
                unlink($del_path);
            }
        }
        echo json_encode(array('err_code'=>0));
    }

    /**
    * KindEditor编辑器文件空间预览
    */
    public function file_manager_json(){
        $php_path = '';
        $php_url = dirname($_SERVER['PHP_SELF']);
        $php_url = $php_url=='/'? '' : $php_url. '/';

        //根目录路径，可以指定绝对路径，比如 /var/www/attached/
        $root_path = $php_path . 'Public/uploads/';
        //根目录URL，可以指定绝对路径，比如 http://www.yoursite.com/attached/
        $root_url = $php_path . 'Public/uploads/';//$php_url
        //图片扩展名
        $ext_arr = array('gif', 'jpg', 'jpeg', 'png', 'bmp');

        if(!file_exists($root_path)){
            @mkdir($root_path, 0777, true);
        }

        
        //目录名
        $dir_name = empty($_GET['dir']) ? '' : trim($_GET['dir']);
        $dir_name = str_replace('..', '', $dir_name);
        /*if (!in_array($dir_name, array('', 'image', 'flash', 'media', 'file'))) {
            echo "Invalid Directory name.";
            exit;
        }*/
        $path = $_GET['path'];
        $path = str_replace('..', '', $path);

        if ($dir_name !== '') {
            $root_path .= $dir_name . "/";
            $root_url .= $dir_name . "/";
            if (!file_exists($root_path)) {
                //@mkdir($root_path, 0777, true);
                //相对于根目录的当前目录
                $result['current_dir_path'] = $path;
                //相对于根目录的上一级目录
                $result['moveup_dir_path'] = preg_replace('/(.*?)[^\/]+\/$/', '$1', $path);
                //当前目录的URL
                $result['current_url'] = $root_url . $path;
                //文件数
                $result['total_count'] = 0;
                //文件列表数组
                $result['file_list'] = array();
                echo json_encode($result);
                exit;
            }
        }

        //根据path参数，设置各路径和URL
        if (empty($path)) {
            $current_path = realpath($root_path) . '/';
            $current_url = $root_url;
            $current_dir_path = '';
            $moveup_dir_path = '';
        } else {
            $current_path = realpath($root_path) . '/' . $path;
            $current_url = $root_url . $path;
            $current_dir_path = $path;
            $moveup_dir_path = preg_replace('/(.*?)[^\/]+\/$/', '$1', $current_dir_path);
        }
        //排序形式，name or size or type
        global $file_manager_order;
        $file_manager_order = empty($_GET['order']) ? 'name' : strtolower($_GET['order']);

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
            global $file_manager_order;
            $order = $file_manager_order;
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
        function alert($msg) {
            header('Content-type: text/html; charset=UTF-8');
            echo json_encode(array('error' => 1, 'message' => $msg));
            exit;
        }
        $php_path = '';
        $php_url = dirname($_SERVER['PHP_SELF']);
        $php_url = $php_url=='/'? '' : $php_url. '/';

        //文件保存目录路径
        $save_path = $php_path . 'Public/uploads/';
        //文件保存目录URL
        $save_url = $php_path . 'Public/uploads/';//$php_url
        //定义允许上传的文件扩展名
        $ext_arr = array(
            'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
            'flash' => array('swf', 'flv'),
            'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
            'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
        );
        $ext_arr_all = array();
        foreach($ext_arr as $item){
            $ext_arr_all = array_merge($ext_arr_all, $item);
        }
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
            $customs = $_GET['customs']*1;
            $autofolder = $_GET['autofolder']*1;

            $dir_name = $_GET['dir'];
            $dir_name = str_replace('..', '', $dir_name);
            $dir_name = $customs? $dir_name : (empty($dir_name) ? 'image' : $dir_name);
            
            if (empty($ext_arr[$dir_name]) && !$customs) {
                alert("目录名不正确。");
            }

            //获得文件扩展名
            $temp_arr = explode(".", $file_name);
            $file_ext = array_pop($temp_arr);
            $file_ext = trim($file_ext);
            $file_ext = strtolower($file_ext);
            //检查扩展名
            if (in_array($file_ext, $ext_arr[$dir_name]) === false && !$customs) {
                alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr[$dir_name]) . "格式。");
            }
            if(in_array($file_ext, $ext_arr_all) === false && $customs){
                alert("上传文件扩展名是不允许的扩展名。\n只允许" . implode(",", $ext_arr_all) . "格式。");
            }
            //创建文件夹
            if ($dir_name !== '') {
                $save_path .= $dir_name . "/";
                $save_url .= $dir_name . "/";
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }
            }

            $path = trim($_GET['path'], '/');
            $path = str_replace('..', '', $path);
            $ymd = $customs&&$path? ($autofolder? $path . '/' . date("Ym") : $path) : date("Ym");

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
            //裁剪图片
            $width = $_REQUEST['width']*1;
            $height = $_REQUEST['height']*1;
            if($width>0 && $height>0){
                import('ORG.Util.Image');
                if($_REQUEST['forcecut']){
                    Image::thumb2($file_path, $file_path, '', $width, $height); //强制裁剪尺寸，多余被裁掉
                }else{
                    Image::thumb($file_path, $file_path, '', $width, $height);
                }
            }

            @chmod($file_path, 0644);
            $file_url = $save_url . $new_file_name;

            header('Content-type: text/html; charset=UTF-8');
            echo json_encode(array('error' => 0, 'url' => $file_url));
            exit;
        }
    }

    /**
    * 单个上传
    */
    public function swfupload(){
        function HandleError($message, $code=501) {
            //header("HTTP/1.1 $code Internal Server Error");
            //echo $message;
            $rt = array('info'=>$message, 'status'=>0);
            header('Content-type: text/html; charset=UTF-8');
            echo "<script>var _upfn = window.parent.{$callback};_upfn?_upfn(". json_encode($rt) ."):console.log(". json_encode($rt) .");</script>";
        }

        $folder = $_REQUEST['folder'];
        $folder = str_replace('..', '', $folder);
        $folder = $folder? $folder.'/' : '';
        
        // swfupload for session id
        if (isset($_POST["PHPSESSID"])) {
            session_id($_POST["PHPSESSID"]);
        } else if (isset($_GET["PHPSESSID"])) {
            session_id($_GET["PHPSESSID"]);
        }

        session_start();

    // 上传权限判断
        /*if(!$_SESSION[fuid]>0){
            header("HTTP/1.1 401 Unauthorized");
            echo $message;
            exit(0);
        }*/
        

    // 前端配置的文件大小验证
        $POST_MAX_SIZE = ini_get('post_max_size');
        $unit = strtoupper(substr($POST_MAX_SIZE, -1));
        $multiplier = ($unit == 'M' ? 1048576 : ($unit == 'K' ? 1024 : ($unit == 'G' ? 1073741824 : 1)));

        if ((int)$_SERVER['CONTENT_LENGTH'] > $multiplier*(int)$POST_MAX_SIZE && $POST_MAX_SIZE) {
            header("HTTP/1.1 500 Internal Server Error");
            echo "POST exceeded maximum allowed size.";
            exit(0);
        }

    // 服务端安全限制配置
        // 保存的路径 
        $save_folder = "Public/uploads/". $folder . date(Ym);
        $save_path = getcwd() . "/" . $save_folder . "/"; 
        @mkdir($save_path, 0777, true);
        
        //swf提交文件表单的参数名
        $upload_name = "Filedata";
        
        // 服务端上传文件大小安全限制 10MB in bytes
        $max_file_size_in_bytes = 10*1048576;				
        
        // 服务端允许上传文件格式安全限制
        $filetyps = "jpg/jpeg/gif/png";
        $filetyps .= "/txt/doc/docx/xls/xlsx/ppt/pptx/rar/zip/pdf";
        $extension_whitelist = explode('/', $filetyps);        

        // 文件名称，留空则使用原文件名保存
        $n = date("YmdHms").rand(1000,9999);
        $file_name = $n;

        // 服务端按照原文件名保存，允许的文件名字符
        $valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';
        
     
        $MAX_FILENAME_LENGTH = 260;
        $file_extension = "";
        $uploadErrors = array(
            0=>"文件上传成功",
            1=>"上传的文件超过了 php.ini 文件中的 upload_max_filesize directive 里的设置",
            2=>"上传的文件超过了 HTML form 文件中的 MAX_FILE_SIZE directive 里的设置",
            3=>"上传的文件仅为部分文件",
            4=>"没有文件上传",
            6=>"缺少临时文件夹"
        );

        if (!isset($_FILES[$upload_name])) {
            HandleError("No upload found in \$_FILES for " . $upload_name, 501);
            exit(0);
        } else if (isset($_FILES[$upload_name]["error"]) && $_FILES[$upload_name]["error"] != 0) {
            HandleError($uploadErrors[$_FILES[$upload_name]["error"]], 502);
            exit(0);
        } else if (!isset($_FILES[$upload_name]["tmp_name"]) || !@is_uploaded_file($_FILES[$upload_name]["tmp_name"])) {
            HandleError("Upload failed is_uploaded_file test.", 503);
            exit(0);
        } else if (!isset($_FILES[$upload_name]['name'])) {
            HandleError("File has no name.", 504);
            exit(0);
        }
        
        $file_size = @filesize($_FILES[$upload_name]["tmp_name"]);
        if (!$file_size || $file_size > $max_file_size_in_bytes) {
            HandleError("File exceeds the maximum allowed size", 505);
            exit(0);
        }
        
        if ($file_size <= 0) {
            HandleError("File size outside allowed lower bound", 506);
            exit(0);
        }

        $path_info = pathinfo($_FILES[$upload_name]['name']);
        $file_extension = $path_info["extension"];

        $file_upload_name = preg_replace('/[^'.$valid_chars_regex.']|\.+$/i', "",basename($_FILES[$upload_name]['name']));
        $file_name = $file_name!='' ? $file_name . "." . $file_extension :  $file_upload_name;
        if (strlen($file_name) == 0 || strlen($file_name) > $MAX_FILENAME_LENGTH) {
            HandleError("Invalid file name", 507);
            exit(0);
        }


        if (file_exists($save_path . $file_name)) {
            HandleError("File with this name already exists", 508);
            exit(0);
        }

    // Validate file extension
        $is_valid_extension = false;
        foreach ($extension_whitelist as $extension) {
            if (strcasecmp($file_extension, $extension) == 0) {
                $is_valid_extension = true;

                break;
            }
        }
        if (!$is_valid_extension) {
            HandleError("Invalid file extension", 509);
            exit(0);
        }
         
       
        if (!@move_uploaded_file($_FILES[$upload_name]["tmp_name"], $save_path.$file_name)) {
            HandleError("文件无法保存.", 510);
            exit(0);
        }else{

        }
        $file_path = $save_folder . '/' . $file_name;

        //裁剪图片
        $width = $_REQUEST['width']*1;
        $height = $_REQUEST['height']*1;
        if(in_array($file_extension, array('gif', 'jpg', 'jpeg', 'png', 'bmp')) && $width>0 && $height>0){
            import('ORG.Util.Image');
            if($_REQUEST['forcecut']){
                Image::thumb2($file_path, $file_path, '', $width, $height); //强制裁剪尺寸，多余被裁掉
            }else{
                Image::thumb($file_path, $file_path, '', $width, $height);
            }
        }

        //echo $file_path;
        $flist = array();
        $flist[] = array('savename'=>$file_path);
        $rt = array('data'=>$flist, 'info'=>'', 'status'=>1);
        $callback = $_GET['callback'];
        $callback = $callback? $callback : 'uploadSuccess';

        header('Content-type: text/html; charset=UTF-8');
        
        echo "<script>var _upfn = window.parent.{$callback};_upfn?_upfn(". json_encode($rt) ."):console.log(". json_encode($rt) .");</script>";
        exit(0);
    }

}