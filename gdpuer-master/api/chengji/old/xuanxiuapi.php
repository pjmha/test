﻿<?php header("Content-type: text/html; charset=utf-8");
 ini_set("display_errors", 0);
include("dom.php");



$xh = $_REQUEST['xh'];
$pw = $_REQUEST['pw'];

if(isset($_REQUEST['xh'])&&isset($_REQUEST['pw'])){
//$ret=write_personinfo($xh,$pw);
//提交账号和密码，身份模拟登陆
$info=write_personinfo($_REQUEST['xh'],$_REQUEST['pw']);
if($info=="获取失败..."){
echo '<script>$.fancybox("请确认用户名或密码是否正确"); setTimeout("$.fancybox.close()",4000); </script><script>ShowMessage("获取失败...请检查你的用户名或密码是否正确","#FFCCCC")</script>';
}else{
$post_fields 	= '__VIEWSTATE=dDwtNjg3Njk1NzQ3O3Q8O2w8aTwxPjs%2BO2w8dDw7bDxpPDg%2BO2k8MTM%2BO2k8MTU%2BOz47bDx0PHA8O3A8bDxvbmNsaWNrOz47bDx3aW5kb3cuY2xvc2UoKVw7Oz4%2BPjs7Pjt0PHA8bDxWaXNpYmxlOz47bDxvPGY%2BOz4%2BOzs%2BO3Q8cDxsPFZpc2libGU7PjtsPG88Zj47Pj47Oz47Pj47Pj47bDxpbWdETDtpbWdUQzs%2BPvpW9bNHRO98aj%2BzEmn77FHqeOjK&tbYHM='.$xh.'&tbPSW='.$pw.'&ddlSF=%D1%A7%C9%FA&imgDL.x=28&imgDL.y=19';
$submit_url 	= 'http://10.50.17.2/default3.aspx';//提价页面

$ch = curl_init($submit_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_HEADER,1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
$contents = curl_exec($ch);

preg_match('/Set-Cookie: (.*);/i', $contents, $results);
$cookie = $results[1];
curl_close($ch);//提取成功之后的ASP.NetSessionId的cookies

//读取操作页面

/*
$geturl_xsxx = 'http://10.50.17.2/xsxx.aspx?xh='.$xh;//个人信息页面
$geturl_xscj = 'http://10.50.17.2/xscj.aspx?xh='.$xh;//学生成绩页面
           */

$geturl_xx = 'http://10.50.17.2/ryxk.aspx?xh='.$xh;



$header[]='Cookie:'.$cookie;

$ch = curl_init($geturl_xx);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch, CURLOPT_HEADER, 0);

 $string = curl_exec($ch);//输出内容

$string=get_utf8_string($string);//转成utf8

    $html = new simple_html_dom();
    $html->load($string);
    $table=$html->find('table[id=dgXKXX]',0);
    $text=$table->outertext;
	echo $text;
	



}

}


function get_utf8_string($content) 
	{    	  
		$encoding = mb_detect_encoding($content, array('ASCII','UTF-8','GB2312','GBK','BIG5'));  
		return  mb_convert_encoding($content, 'utf-8', $encoding);
	}
function write_personinfo($xh,$pw) 
	{    	  
		$per_info_url='http://10.5.20.40/chengji/personinfo.php?xh='.$xh.'&pw='.$pw;
		$ret_personinfo=file_get_contents($per_info_url);
		return $ret_personinfo;
		
	}


	

?>