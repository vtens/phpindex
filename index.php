<?php
/* PHPINDEX 184 ? https://vtens.com/phpindex
--------------------------------------------------
# APACHE配置文件(httpd.conf)修改3处
|--1, Options Indexes FollowSymLinks (去掉Indexes)
|--2, ErrorDocument 404 /?error (没有添加)
|--3, ErrorDocument 403 /?error (没有添加)
*/

//初始化
ini_set('date.timezone','PRC');
$http = $_SERVER["REQUEST_SCHEME"].'://';
$host = $_SERVER["HTTP_HOST"];
$site = dirname($_SERVER['PHP_SELF']);

//基本配置
$pass = '123'.substr(date('d',time()),-1); //登录密码
$h['version'] = 'PHPINDEX 184';
$h['jquery'] = "<script src='https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js'></script>"; //jquery
$h['jqueryqrcode'] = "<script src='https://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js'></script>"; //jquery
$h['head'] = "<!DOCTYPE HTML><html><head><meta charset='utf-8'/><meta name='author' content='vtens.com'><meta name='viewport' content='width=device-width,user-scalable=no,initial-scale=1'><style>html,body,div,p,a,span,em,i,h1,h2,h3,input{margin:0;padding:0;border:none;outline:none;box-sizing:border-box}body{background:#f1f1f1;color:#123;text-align:center;font:12px/1.5 Tahoma,Helvetica,'Microsoft YaHei';overflow-x:hidden}a:link,a:active,a:visited,a{text-decoration:none;color:#123}input[type=submit]{-webkit-appearance:none</style></head><body>";
$h['foot'] = "<style>.foot{margin:30px auto;font-size:18px}.foot a{color:#ddd;text-shadow:1px 1px #fff;}.foot a:hover{color:#bbb}</style><div class='foot'><a href='//vtens.com/phpindex' target='_blank'>{$h['version']}</a></div></body></html>";
$h['cssm'] = 'width:100%;position:absolute;top:45%;left:50%;text-align:center;transform:translate(-50%,-50%);';

//禁止外网访问
if($host != '127.0.0.1' && $host != 'localhost' && !stristr($host,'192.168')){
	header('HTTP/1.1 403 Forbidden');
	msg('禁止访问');
}

//登录界面
if(isset($_POST['pass']) && $pass == $_POST['pass']){
	setrawcookie('phpindex',md5('tens'.$pass),time()+3600*24,'/');
	header('location:./');
}
if(!isset($_COOKIE['phpindex']) || md5('tens'.$pass) != $_COOKIE['phpindex']){
	die("{$h['head']}<style>.login{{$h['cssm']}width:95%;top:40%}.login .face{font-size:8em;font-weight:800;color:#123}.login input{text-align:center;width:100%;height:50px;font-size:16px;border-bottom:1px solid #ddd;margin-top:50px}.login input[type=submit]{-display:block;height:50px;line-height:50px;padding:0;cursor:pointer;background:#04BE02;color:#FFF;font-size:20px;border-radius:3px;    letter-spacing:4px}.login input[type=submit]:hover{font-weight:900}</style><div class='login'><div class='face'>:-)</div><form action='./' method='post'><input type='password' name='pass' placeholder='输入密码' autocomplete='off' autofocus='autofocus'><input type='submit' value='登录'></form></div></body></html>");
}

//小工具
if(isset($_GET['mobile'])){qrcode();}
if(isset($_GET['logout'])){logout();}
if(isset($_GET['error'])){error();}
if(isset($_GET['info'])){info();}

//显示目录
$file = glob('*',GLOB_ONLYDIR);
if(count($file)){
	$dir = '';
	foreach($file as $v){
		if($v[0] == '@')continue; //@开头隐藏
		$v = iconv('gb2312','utf-8',$v);
		$dir .= "<a class='l' href='{$v}'>{$v}</a>";
	}
	$site = $site == '\\' ? $host : $site;
	$prev = $host.substr($site,0,strripos($site, '/'));
	die("{$h['head']}<style>.head{line-height:110px;text-align:center;background:#123;}.head h1 a{display:block;color:#fff;font-size:36px;text-shadow:1px 0 1px #333;overflow:hidden}.head h1 a:hover{color:yellow}.menu{height:50px;line-height:50px;text-align:center;background:#fff;box-shadow:0 1px 1px #ddd;}.menu a{display:inline-block;float:left;width:33.33333%;height:100%;color:#333;font-size:14px}.menu a:hover{border-bottom:2px solid #123;color:#123}.menu a:not(:last-child){border-right:1px solid #eee;}.main a{display:block;height:60px;line-height:60px;margin-top:15px;text-indent:10px;background:#fff;color:#123;font-size:24px;box-shadow:0 1px 1px #ddd;overflow:hidden}/*.main a:after{content:attr(href);}*/.main a:hover{background:#123;color:#fff;text-shadow:0 0 1px #333;}#search{margin-top:15px;}#search .txt{width:100%;height:48px;line-height:48px;text-align:center;letter-spacing:1px;font:16px/1.5 arial;color:#123;border:none;border-bottom:1px solid #ccc;outline:none;}#logout{display:block;line-height:50px;margin:30px 0;background:#ca1919;color:#fff;text-align:center;font-size:21px;letter-spacing:3px}#logout:hover{font-weight:800}</style><div class='head'><h1><a href='//{$prev}'>{$site}</a></h1></div><div class='menu'><a href='//{$host}/@tool/'>TOOLS</a><a href='?info'>PHPINFO</a><a href='?mobile'>MOBILE</a></div><div id='search'><input type='text' class='txt' placeholder='Search'></div><div class='main'>{$dir}</div><a id='logout' href='//{$host}/?logout'>退出</a>{$h['foot']}{$h['jquery']}<script>$('#search .txt').on('input propertychange',function(){search();});$('#search .txt').focus();function search(){txt = $('#search .txt').val().toUpperCase();$('.main .l').removeClass('s');$('.main .l').each(function(k,v){yes = $(this).text().toUpperCase().indexOf(txt);if(yes != '-1')$(this).addClass('s');});$('.main .l').hide();$('.main .s').show();}$(function(){document.onkeydown = function(e){var ev = document.all ? window.event : e;if(ev.keyCode==13){if($('#search .txt').val()==''){location.href=$('.main .l:first').text();}else{location.href = $('.main .s:first').text();}}}});</script>");
}else{
	msg('请在当前目录下<br/>放入项目文件夹');
}

//地址二维码
function qrcode(){
	global $h;
	$ip = getip();
	if(!$ip)msg('IP地址必须是<br/>192.168 开头');
	$re = pathinfo($_SERVER['SCRIPT_NAME'])['dirname'];
	die("{$h['head']}<style>body{background:#123;color:#fff;}p{font-size:16px;letter-spacing:1px}h1{font-size:2.2em;letter-spacing:3px;}#code{display:block;width:256px;height:256px;margin:0 auto;margin-top:20px;padding:10px;background:#fff}canvas{margin-left:-1px}</style><title>手机扫码浏览</title><div style='{$h['cssm']}'><p>同一局域网内, 手机扫描二维码浏览</p><h1>{$ip}</h1><a id='code' href='./'></a></div>{$h['jquery']}{$h['jqueryqrcode']}<script>$('#code').qrcode({width:236,height:236,text:'http://{$ip}{$re}/'});</script></body></html>");
}

//局域网IP
function getip(){
	$ip = stristr(shell_exec('ipconfig /all'),'192.168');
	return substr($ip,0,stripos($ip,'('));
}

//错误页面
function error(){
	global $h;
	$url = '//'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	$dir = dirname(__FILE__).parse_url($url, PHP_URL_PATH);
	$num = count(explode('/',explode('htdocs/', $dir)[1],-1));
	$ind = "<?php".PHP_EOL."require(\$_SERVER['DOCUMENT_ROOT'].'/index.php');";
	if(is_dir($dir) && !is_file($dir.'index.php') && $num<3){
		file_put_contents($dir.'index.php', $ind);
		header('location:'.$url);die;
	}
	header('HTTP/1.1 404 Not Found');
	msg('404',40);
}

//退出
function logout(){
	setrawcookie('phpindex','',time()-3600);header('location:./');
}

//提醒文字
function msg($str='404',$size='12'){
	global $h;
	die("<title>{$str}</title>{$h['head']}<style>body{font-size:{$size}px;background:#123;}h1{color:#fff;{$h['cssm']}font-size:9em;line-height:1.8;letter-spacing:3px;}</style><h1>{$str}</h1></body></html>");
}

//phpinfo
function info(){
	global $h;
	phpinfo();
	die("<meta name='viewport' content='width=device-width,user-scalable=no,initial-scale=1'><style>.center .h em{text-shadow:1px 1px #fff}</style>{$h['jquery']}<script>$('.center .h h1').after('<em>{$h['version']}</em>').siblings('a').attr('href','./')</script>");
}

