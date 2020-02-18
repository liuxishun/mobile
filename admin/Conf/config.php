<?php
return array(
    //'配置项' => '配置值'
	'URL_MODEL' => 3, 
    // 0 /appName/?m=module&a=action&id=1 
    // 1 PATHINFO  ttp://<serverName>/appName/m/module/a/action/id/1
    // 2 智能模式 系统默认 http://<serverName>/appName/module/action/id/1 http://<serverName>/appName/module,action,id,1(自定分隔符)
    // 3 http://<serverName>/appName/?s=/module/action/id/1/
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'rm-8vb431shd233813u6mo.mysql.zhangbei.rds.aliyuncs.com',
    'DB_NAME' => 'yun',
    'DB_USER' => 'mumway',
    'DB_PWD' => 'Mumway1234!@#$',
    'DB_PORT' => '3306',
    'DB_PREFIX' => 't_',

    'URL_HTML_SUFFIX'       => '',  // html URL伪静态后缀设置
    'URL_CASE_INSENSITIVE'  => true, // 默认false 表示URL区分大小写 true则表示不区分大小写
    'VAR_FILTERS'=>'trim', //get post全局过滤
    'DEFAULT_FILTER' => 'trim', //action中使用$this->_get() 等的，默认默认过滤函数  , strip_tags,htmlspecialchars

    'MY_AUTH_ON' => true, // 是否需要认证
    'MY_AUTH_TYPE' => 2, // 认证类型 1登录验证，2即时验证
    'MY_AUTH_KEY' => 'admin_id', // 认证识别号 session键值
    'MY_ADMIN_AUTH_KEY' => 'supper_admin_id', // 超级管理员 session键值
    'MY_REQUIRE_AUTH_MODULE' => '', //  需要认证模块，逗号做间隔
    'MY_NOT_AUTH_MODULE' => 'Public, Index', // 无需认证模块
    'MY_REQUIRE_AUTH_ACTION' => '', //需要认证的action
    'MY_NOT_AUTH_ACTION' => 'changepsw', //无需要认证的action
    'MY_RBAC_ROLE_TABLE' => 'my_role', // 角色表名称
    'MY_RBAC_USER_TABLE' => 'my_role_user', // 用户表名称
    'MY_RBAC_ACCESS_TABLE' => 'my_access', // 权限表名称
    'MY_RBAC_NODE_TABLE' => 'my_node', // 节点表名称
);
?>
