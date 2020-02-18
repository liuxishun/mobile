<?php

class CommonModel extends Model {
    
    /**
    * 根据年月日获取 年龄、属相、星座
    */
    public function getAgeDataFromDate($dt){
        $t_dt = strtotime($dt);
        if($t_dt===false){
            return false;
        }
        $sx_arr = explode('|','鼠|牛|虎|兔|龙|蛇|马|羊|猴|鸡|狗|猪');
        $sx_base = 1984;
        $sx_idx = 0;
        list($y, $m, $d) = explode('-', date('Y-m-d', $t_dt));
        $rt = array();
        $rt['age'] = date('Y') - $y;

        $idx = $sx_idx + (($y-$sx_base)%12);
        $idx = $idx>=0? $idx : 12+$idx;
        $rt['shuxiang'] = $sx_arr[$idx];

        $rt['xingzuo'] = $this->yige_constellation($m*1, $d*1);

        return $rt;
    }

    
    /**
    * 月日转星座
    */
    public function yige_constellation($month, $day) {
         // 检查参数有效性 
         if ($month < 1 || $month > 12 || $day < 1 || $day > 31) return false;

         // 星座名称以及开始日期
         $constellations = array(
          array( "20" => "水瓶座"),
          array( "19" => "双鱼座"),
          array( "21" => "白羊座"),
          array( "20" => "金牛座"),
          array( "21" => "双子座"),
          array( "22" => "巨蟹座"),
          array( "23" => "狮子座"),
          array( "23" => "处女座"),
          array( "23" => "天秤座"),
          array( "24" => "天蝎座"),
          array( "22" => "射手座"),
          array( "22" => "摩羯座")
         );

         list($constellation_start, $constellation_name) = each($constellations[(int)$month-1]);

         if ($day < $constellation_start) list($constellation_start, $constellation_name) = each($constellations[($month -2 < 0) ? $month = 11: $month -= 2]);

         return $constellation_name;
    }
    
    //前后台公用模型

    private function fsocketopen($hostname, $port = 80, &$errno, &$errstr, $timeout = 15) {
        $fp = '';
        if(function_exists('fsockopen')) {
            $fp = @fsockopen($hostname, $port, $errno, $errstr, $timeout);
        } elseif(function_exists('pfsockopen')) {
            $fp = @pfsockopen($hostname, $port, $errno, $errstr, $timeout);
        } elseif(function_exists('stream_socket_client')) {
            $fp = @stream_socket_client($hostname.':'.$port, $errno, $errstr, $timeout);
        }
        return $fp;
    }
    
    /**
    * 兼容性较好的socket通信方法
    */
    public function api_fopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE, $encodetype  = 'URLENCODE', $allowcurl = TRUE) {
        $return = '';
        $matches = parse_url($url);
        $scheme = $matches['scheme'];
        $host = $matches['host'];
        $path = $matches['path'] ? $matches['path'].($matches['query'] ? '?'.$matches['query'] : '') : '/';
        $port = $scheme=='https'? 443 : (!empty($matches['port']) ? $matches['port'] : 80);

        if(function_exists('curl_init') && $allowcurl) {
            $ch = curl_init();
            $ip && curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: ".$host));
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_URL, $scheme.'://'.($ip ? $ip : $host).':'.$port.$path);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            if($post) {
                curl_setopt($ch, CURLOPT_POST, 1);
                if($encodetype == 'URLENCODE') {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                } else {
                    parse_str($post, $postarray);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $postarray);
                }
            }
            if($cookie) {
                curl_setopt($ch, CURLOPT_COOKIE, $cookie);
            }
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);
            $status = curl_getinfo($ch);
            $errno = curl_errno($ch);
            curl_close($ch);
            if($errno || $status['http_code'] != 200) {
                return;
            } else {
                return !$limit ? $data : substr($data, 0, $limit);
            }
        }

        $scheme = str_replace('https', 'ssl', $scheme);
        $scheme = str_replace('http', 'tcp', $scheme);
        if($post) {
            $out = "POST $path HTTP/1.1\r\n";
            $header = "Accept: */*\r\n";
            $header .= "Accept-Language: zh-cn\r\n";
            $boundary = $encodetype == 'URLENCODE' ? '' : '; boundary='.trim(substr(trim($post), 2, strpos(trim($post), "\n") - 2));
            $header .= $encodetype == 'URLENCODE' ? "Content-Type: application/x-www-form-urlencoded\r\n" : "Content-Type: multipart/form-data$boundary\r\n";
            $header .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
            $header .= "Host: $host:$port\r\n";
            $header .= 'Content-Length: '.strlen($post)."\r\n";
            $header .= "Connection: Close\r\n";
            $header .= "Cache-Control: no-cache\r\n";
            $header .= "Cookie: $cookie\r\n\r\n";
            $out .= $header.$post;
        } else {
            $out = "GET $path HTTP/1.0\r\n";
            $header = "Accept: */*\r\n";
            $header .= "Accept-Language: zh-cn\r\n";
            $header .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
            $header .= "Host: $host:$port\r\n";
            $header .= "Connection: Close\r\n";
            $header .= "Cookie: $cookie\r\n\r\n";
            $out .= $header;
        }

        $fpflag = 0;
        if(!$fp = @$this->fsocketopen($scheme.'://'.($ip ? $ip : $host), $port, $errno, $errstr, $timeout)) {
            $context = array(
                'http' => array(
                    'method' => $post ? 'POST' : 'GET',
                    'header' => $header,
                    'content' => $post,
                    'timeout' => $timeout,
                ),
            );
            $context = stream_context_create($context);
            $fp = @fopen($scheme.'://'.($ip ? $ip : $host).':'.$port.$path, 'b', false, $context);
            $fpflag = 1;
        }

        if(!$fp) {
            return '';
        } else {
            stream_set_blocking($fp, $block);
            stream_set_timeout($fp, $timeout);
            @fwrite($fp, $out);
            $status = stream_get_meta_data($fp);
            if(!$status['timed_out']) {
                while (!feof($fp) && !$fpflag) {
                    if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n")) {
                        break;
                    }
                }

                $stop = false;
                while(!feof($fp) && !$stop) {
                    $data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
                    $return .= $data;
                    if($limit) {
                        $limit -= strlen($data);
                        $stop = $limit <= 0;
                    }
                }
            }
            @fclose($fp);
            return $return;
        }
    }

    private function array_encode( $arr ) { 
        if(is_array($arr)){
            foreach($arr as $k=>$v){
                if(is_array($v)){
                    $arr[$k]=$this->array_encode($v);
                }else{
                    $arr[$k]=urlencode($v);
                }
            }
        }else{
            $arr=urlencode($arr);
        }
        return $arr;
    }

    /**
    * 汉字不被编码的json编码格式
    */
    public function my_json_encode( $arr ) { 
        $arr = $this->array_encode( $arr );
        $ret = urldecode(json_encode($arr));
        $ret = str_replace("\r", "\\r", $ret);
        $ret = str_replace("\n", "\\n", $ret);
        $ret = str_replace("\t", "\\t", $ret);
        return $ret;
    }
}