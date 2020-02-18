<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL' => 1, 
    // 0 /appName/?m=module&a=action&id=1 
    // 1 PATHINFO  ttp://<serverName>/appName/m/module/a/action/id/1
    // 2 智能模式 系统默认 http://<serverName>/appName/module/action/id/1 http://<serverName>/appName/module,action,id,1(自定分隔符)
    // 3 http://<serverName>/appName/?s=/module/action/id/1/
	'DB_TYPE' => 'mysql',
//    'DB_HOST' => 'rm-8vb431shd233813u6mo.mysql.zhangbei.rds.aliyuncs.com',
	'DB_HOST' => '39.98.241.29',
//    'DB_NAME' => 'yun',
	'DB_NAME' => 'yun_online',
//    'DB_USER' => 'mumway',
	'DB_USER' => 'root',
//    'DB_PWD' => 'Mumway1234!@#$',
	'DB_PWD' => 'h.y.m.m.KXC@22',
	'DB_PORT' => '3306',
	'DB_PREFIX' => 't_',

	'LOG_RECORD' => false, // 关闭日志记录
	'TMPL_CACHE_ON' => false,
	
    //'URL_HTML_SUFFIX'       => '',  // html URL伪静态后缀设置
    'URL_CASE_INSENSITIVE'  => true, // 默认false 表示URL区分大小写 true则表示不区分大小写
    'VAR_FILTERS'=>'trim', //get post全局过滤
    'DEFAULT_FILTER' => 'trim', //action中使用$this->_get() 等的，默认默认过滤函数  , strip_tags,htmlspecialchars

    //数据库缓存表
    'DATA_CACHE_TABLE' => 'think_cache',

    'DEMO'=> 1,
);
?>
