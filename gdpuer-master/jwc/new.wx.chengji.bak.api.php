﻿<?php
header("content-Type: text/html; charset=utf-8");
include("db.php");

$nf='2013-2014';
$xh=$_GET['xh'];
$pw=$_GET['pw'];
$api_url='http://ours.123nat.com:59832/api/jwcapi.php?xh='.$xh.'&pw='.$pw.'&flag=2';
$str=file_get_contents($api_url);

$tj='http://pingtcss.qq.com/pingd?dm=yanson.duapp.com&pvi='.rand(1,9999999999).'&si=s'.rand(1,9999999999).'&url=/jwc/new.wx.chengji.api.php&arg=&ty=&rdm=&rurl=&rarg=&adt=&r2=31957828&r3=-1&r4=1&fl=12.0&scr=1280x960&scl=24-bit&lg=zh-cn&jv=1&tz=-8&ct=&ext=adid=&pf=&random=1397458406451';
file_get_contents($tj);
if(strstr($str,"<script>")){
echo "【账号】或【密码】错误";
return;
}


{//输出名字
$sql_name = "SELECT * FROM `jwc_personinfo` WHERE `xh` = '{$xh}' LIMIT 1 ";
$query_char=mysql_query("SET NAMES UTF8");
$query_name=mysql_query($sql_name,$link) or die(mysql_error());
$name_ret=mysql_fetch_row($query_name);
$name=$name_ret[2];
$xb=$name_ret[4];
if($xb=='男'){$ch='同学';}
if($xb=='女'){$ch='同学';}
}


{//搜索数据库是否已经有数据
$sql_check = "SELECT * FROM `jwc_chengji` WHERE `xh` = '{$xh}' LIMIT 1 ";
$query_char=mysql_query("SET NAMES UTF8");
$query_check=mysql_query($sql_check,$link) or die(mysql_error());
$check_ret=mysql_fetch_row($query_check);
}

/* 判断0910级
if(mb_strcut($xh, 0, 2, 'utf-8')=='10'||mb_strcut($xh, 0, 2, 'utf-8')=='09'){
  echo "亲爱的{$name} {$ch}\n\n由于您的成绩数据太多了...微信显示不过来，希望您能到网站上查询\n\nPC网页版查询地址\n\nwww.i694.net\chengji\n(节省流量推荐用电脑打开)\n\n给你们带来不便\n望能多多体谅";
return;

}
*/
$string=$check_ret[2];
/*
$str2=explode($nf,$check_ret[2]);
		$string='';
		foreach($str2 as $key=>$a){
			if($key>=1){
			$a=$nf.$a;
			$string=$string.$a;
			}
        }
		*/
if($string=="\n\n"){

  $title="{$name} {$ch}欢迎使用\n【广药学生成绩查询】";
echo $title."\n\n".$string;
po_chengji_new($str,$xh,$name,$ch,$link);
}
if(!$check_ret[1]){
echo "亲爱的{$name} {$ch}\n正在为你链接到教务处...\n请重新发送\n\n成绩#学号#密码\n\n来获得最新成绩信息";
po_chengji_new($str,$xh,$name,$ch,$link);
}else{
$title="{$name} {$ch}欢迎使用\n【广药学生成绩查询】";
echo $title."\n\n".$string;
po_chengji_new($str,$xh,$name,$ch,$link);
}



function get_utf8_string($content) 
	{    	  
		$encoding = mb_detect_encoding($content, array('ASCII','UTF-8','GB2312','GBK','BIG5'));  
		return  mb_convert_encoding($content, 'utf-8', $encoding);
	}
	
function po_chengji_db($xh,$name,$ret,$link) 
	{    	  
		$sql_po_chengji = "REPLACE INTO `jwc_chengji` (`xh`, `name`,`chengji`, `time`) VALUES ('{$xh}','{$name}', '{$ret}', TIMESTAMP(10));";
        $query_char=mysql_query("SET NAMES UTF8");
        $query_po_chengji=mysql_query($sql_po_chengji,$link) or die(mysql_error());
	}

function po_chengji($str,$xh,$name,$ch,$link) 
	{    
		$zxfxj=get_utf8_string("%实得总学分小计:");
		$pjxfjd=get_utf8_string("%平均学分绩点:");
		$zxfjd=get_utf8_string("%总学分绩点");

		$str=str_replace("</font></span></td>  	</tr>","%",$str);
		$str=str_replace("</td>  	</tr>","】",$str);
		$str=str_replace("<tr>  		<td>","【",$str);
		$str=str_replace('<tr bgcolor="#C1D8F0">  		<td>',"【",$str);
		$str=str_replace('<tr bgcolor="#EEF3F9">  		<td>',"【",$str);
		$str=str_replace('<span id="Szxf"><font color="MediumBlue">',$zxfxj,$str);
		$str=str_replace('<span id="pjxfjd">',$pjxfjd,$str);
		$str=str_replace('<span id="zxfjd"><font color="DarkRed">',$zxfjd,$str);
		$str=str_replace('<span id="yhzxf"><font color="DarkRed">',"%",$str);
		$str=str_replace('</font></span>',"%】",$str);
		$str=str_replace("<td>&nbsp;</td>","",$str);
		$str=str_replace("<td>"," ",$str);
		$str=str_replace("<tr>","",$str);
		$str=str_replace("</tr>"," ",$str);
		$str=strip_tags($str);


		$str=explode("%",$str);
		$str2=explode("【",$str[0]);

		$string='';
		foreach($str2 as $key=>$a){
			if($key>=2){
			$a=str_replace("】","\n\n",$a);
			$string=$string.$a;
			}
	
		}
		
		
		$ret=$string."\n".$str[4]."\n".$str[6]."\n".$str[8];
	if($string!=="\n\n"){
		$sql_po_chengji = "REPLACE INTO `jwc_chengji` (`xh`, `name`,`chengji`, `time`) VALUES ('{$xh}','{$name}', '{$ret}', TIMESTAMP(10));";
        $query_char=mysql_query("SET NAMES UTF8");
        $query_po_chengji=mysql_query($sql_po_chengji,$link) or die(mysql_error());
	}
	}
	
function po_chengji_new($str,$xh,$name,$ch,$link){
	preg_match('/<table cellspacing=\"0\" cellpadding=\"3\" rules=\"rows\" bordercolor=\"#ADCEEF\" border=\"1\" id=\"DataGrid1\" width=\"100%\">(?P<info>.+?)<\/table>/s', $str, $results);
	$array=get_td_array($results['info']);
	array_splice($array, 0, 1);

	/*
	 Array
			(
				[0] => 学年
				[1] => 学期
				[2] => 课程名称
				[3] => 课程类型
				[4] => 任课教师
				[5] => 考核方式
				[6] => 总评成绩
				[7] => 补考成绩
				[8] => 重修成绩
				[9] => 重修成绩2
				[10] => 重修成绩3
				[11] => 绩点
				[12] => 应得学分
			)
	 */
	for ($i = 0; $i < count($array); $i++)
	{
		 for ($j = 0; $j < count($array[$i]); $j++)
		 {
			if ($array[$i][$j] == "&nbsp;")
			{
				$array[$i][$j] = "";
			}
			$array[$i][$j]=trim($array[$i][$j]);
		}
	}
	//print_r($array);

	//取出最后一学期的成绩
	$cj='';
	$str='';
	$xn="";
	for ($i = count($array)-1; $i >= 0; $i--)
	{
		$cj='';
		$cj="课程名称：".$array[$i][2]."\n"."课程类型：".$array[$i][3]."\n"."任课教师：".$array[$i][4]."\n"."总评成绩：".$array[$i][6]."\n";
		//判断最终成绩
		
		if(!empty($array[$i][7]))
		{
			$cj.="补考成绩：".$array[$i][7]."\n";
		}
		elseif (!empty($array[$i][8]))
		{
			$cj.="重修成绩：".$array[$i][8]."\n";
		}
		elseif (!empty($array[$i][9]))
		{
			$cj.="重修成绩2：".$array[$i][9]."\n";
		}
		elseif (!empty($array[$i][10]))
		{
			$cj.="重修成绩3：".$array[$i][10]."\n";
		}

		$cj.="绩点：".$array[$i][11]."\n"."应得学分：".$array[$i][11]."\n----------\n";
		
		//学年不一样时结束循环
		if ($array[$i][0] != $array[$i-1][0])
		{
		break;
			
		}
		if($array[$i-1][1] == '1' && $array[$i][1] != $array[$i-1][1])
		{
		 $cj.=$array[$i-1][0]."学年\n第 ".$array[$i-1][1]." 学期\n----------\n";
		}
		
		$str.=$cj;
		

	}
	$ret=$array[count($array)-1][0]."学年\n第 ".$array[count($array)-1][1]." 学期\n----------\n".$str;
	$sql_po_chengji = "REPLACE INTO `jwc_chengji` (`xh`, `name`,`chengji`, `time`) VALUES ('{$xh}','{$name}', '{$ret}', TIMESTAMP(10));";
    $query_char=mysql_query("SET NAMES UTF8");
    $query_po_chengji=mysql_query($sql_po_chengji,$link) or die(mysql_error());
}

function get_td_array($table)

{
  $table = preg_replace("'<table[^>]*?>'si","",$table);
  $table = preg_replace("'<tr[^>]*?>'si","",$table);
  $table = preg_replace("'<td[^>]*?>'si","",$table);
  $table = str_replace("</tr>","{tr}",$table);
  $table = str_replace("</td>","{td}",$table);
  //去掉 HTML 标记 
  $table = preg_replace("'<[/!]*?[^<>]*?>'si","",$table);
  //去掉空白字符  
  $table = preg_replace("'([rn])[s]+'","",$table);
  $table = str_replace(" ","",$table);
  $table = str_replace(" ","",$table);
  $table = explode('{tr}', $table);
  array_pop($table);
  foreach ($table as $key=>$tr)
  {
      $td = explode('{td}', $tr);
      array_pop($td);
      $td_array[] = $td;
  }
   return $td_array;
}	
//print_r($str);
?>