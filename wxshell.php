<?php
/**
*微信分享验证接口
*/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers:Authorization,Origin, X-Requested-With, Content-Type, Accept");
//header("Access-Control-Allow-Methods:GET,POST");
require_once "Public/wx/jssdk.php";
$jssdk = new JSSDK("wxcd720e416bcaaa0d", "e5ebc693eeb62f3ab03253297a5a41e7");
$signPackage = $jssdk->GetSignPackageURL();
echo json_encode($signPackage);exit;
?>