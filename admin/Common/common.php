<?php
//数组trim
if ( ! function_exists('array_trim')){
    function array_trim( $arr ) { 
        if(is_array($arr)){
            foreach($arr as $k=>$v){
                if(is_array($v)){
                    $arr[$k]=array_trim($v);
                }else{
                    $arr[$k]=trim($v);
                }
            }
        }else{
            $arr=trim($arr);
        }
        return $arr;
    }
}

if ( ! function_exists('string2array')){
    /**
    * 将字符串转换为数组
    *
    * @param	string	$data	字符串
    * @return	array	返回数组格式，如果，data为空，则返回空数组
    */
    function string2array($data) {
        if($data == '') return array();
        $data = stripslashes($data);
        @eval("\$array = $data;");
        return $array;
    }
}
if ( ! function_exists('array2string')){
    /**
    * 将数组转换为字符串
    *
    * @param	array	$data		数组
    * @param	bool	$isformdata	如果为0，则不使用new_stripslashes处理，可选参数，默认为1
    * @return	string	返回字符串，如果，data为空，则返回空
    */
    function array2string($data, $isformdata = 1) {
        if($data == '') return '';
        if($isformdata) $data = new_stripslashes($data);
        return addslashes(var_export($data, TRUE));
    }
}
if ( ! function_exists('new_stripslashes')){
    /**
     * 返回经stripslashes处理过的字符串或数组
     * @param $string 需要处理的字符串或数组
     * @return mixed
     */
    function new_stripslashes($string) {
        if(!is_array($string)) return stripslashes($string);
        foreach($string as $key => $val) {
            if(is_array($val)){
                $string[$key] = new_stripslashes($val);
            }else{
                $string[$key] = stripslashes($val);
            }
        }
        return $string;
    }
}
if ( ! function_exists('maskStr')){
	/**
	* 添加*号
    * maskStr($str, -8, -4)
    * maskStr($name, 1, 3, 'utf-8')
	*/
	function maskStr($str, $start, $end, $encode='GBK'){
		$l = mb_strlen($str, $encode);
		if($l==0 || $l < ($start>=0? $start : $l+$start)) return $str;
        $end = $end>$l? $l : $end;
		for($i=$start;$i<$end;$i++){
		    $mask .= '*';
		}
		return mb_substr($str, 0, $start, $encode) . $mask . mb_substr($str, $end, $l, $encode);
	}
}
if ( ! function_exists('trim_script')){
    /**
     * 转义 javascript 代码标记
     *
     * @param $str
     * @return mixed
     */
    function trim_script($str) {
        $str = preg_replace ( '/\<([\/]?)script([^\>]*?)\>/si', '&lt;\\1script\\2&gt;', $str );
        //$str = preg_replace ( '/\<([\/]?)iframe([^\>]*?)\>/si', '&lt;\\1iframe\\2&gt;', $str );
        //$str = preg_replace ( '/\<([\/]?)frame([^\>]*?)\>/si', '&lt;\\1frame\\2&gt;', $str );
        $str = preg_replace ( '/]]\>/si', ']] >', $str );
        return $str;
    }
}
if ( ! function_exists('substring')){
	/**
	* 截断字符
    * substring($str, 18, "utf-8"); 
    * substring($str, 18, "utf-8"); 
	*/
    function substring($str, $len, $code="utf-8", $end="..."){ 
        $str = preg_replace("|<[^>]*>|", "", $str); 
        $str = preg_replace("|\\s{2,}|", "", $str); 
        $l = mb_strlen($str, $code); 

        $ret = ""; 
        $count = 0; 
        for($i=0; $i<$l; $i++){ 
            $chart = mb_substr($str, $i, 1, $code); 
            if(strlen($chart)==1){ 
                $count += 1; 
            }else{ 
                $count += 2; 
            } 
            if($count>$len){ 
                return $ret . $end; 
            }else{ 
                $ret .= $chart; 
            } 
        } 
        return $ret;
    } 
}

if ( ! function_exists('fixurl')){
	/**
	* 去掉url中的某个参数
    * fixurl("page", $url); 
	*/
    function fixurl($paras, $url=null) {
		$url = $url!==null? $url : $_SERVER["REQUEST_URI"];
        if(is_array($paras)){
            foreach($paras as $para){
                $url = preg_replace("#$para=[^&]*|&$para=[^&]*#i", "", $url);
            }
        }else{
            $url = preg_replace("#$paras=[^&]*|&$paras=[^&]*#i", "", $url);
        }
        return $url;
	}
}
if ( ! function_exists('genColname')){
	/**
	* 生成excel列号
	*/
    function genColname($idx){
        $ks = explode("|", "A|B|C|D|E|F|G|H|I|J|K|L|M|N|O|P|Q|R|S|T|U|V|W|X|Y|Z");
        $d = floor($idx / 26);
        $m = $idx % 26;
        if($d==0 && $m!=0){
            return $ks[$idx-1];
        }else if($d==1 && $m==0){
            return $ks[25];
        }else if($d>=1 && $m!=0){
            return $ks[$d-1] . $ks[$m-1];
        }else if($d>1 && $m==0){
            return $ks[$d-2] . $ks[25];
        }else{
            return "";
        }
    }
}