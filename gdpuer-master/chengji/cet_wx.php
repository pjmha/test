<?php
header("content-Type: text/html; charset=utf-8");

//--连接数据库8.19
	   // $dbname = 'fPbhUckfqXdcQiuSglFR';//这里填写你BAE数据库的名称
 
    //    /*从环境变量里取出数据库连接需要的参数*/
    //    $host = "localhost";
    //    $port = "80";
    //    $user = "gdpuer";
    //    $pwd = "ourstudio";
 
    //    /*接着调用mysql_connect()连接服务器*/
    //    $link = @mysql_connect("{$host}:{$port}",$user,$pwd,true);
    //    if(!$link) {
    //                die("Connect Server Failed: " . mysql_error($link));
    //               }
    //    /*连接成功后立即调用mysql_select_db()选中需要连接的数据库*/
    //    if(!mysql_select_db($dbname,$link)) {
    //                die("Select Database Failed: " . mysql_error($link));
    //               }
//以上连接数据库8.19

//8.19
// $nj_input=$_REQUEST['xh'];
// $perNumber=$_REQUEST['num'];
// if(!$perNumbern){$perNumber=30; }//每页显示的记录数
// if(!$nj_input){$nj_input='学号';}

// $sql_name = "SELECT * FROM `132cetno` WHERE `学号` like '%$nj_input%' ";
// $query_char=mysql_query("SET NAMES UTF8");
// $query_name=mysql_query($sql_name,$lik) or die(mysql_error());
//8.19
$zkzh=$_REQUEST['zkzh'];
$xm=$_REQUEST['xm'];

echo "\t【广药小助手】\n\t【cet成绩查询】\n▶我是最帅的分隔符";
//8.19
// while($name_ret=mysql_fetch_row($query_name)){
// $xh=$name_ret[0];
// $jb=$name_ret[1];
// $xq=$name_ret[2];
// $yx=$name_ret[3];
// $bj=$name_ret[4];
// $xh=$name_ret[5];
// $xm=$name_ret[6];  
// $zkz=$name_ret[7];
//8.19

  //echo $xh.'<br>'.$pw.'<br>'.$name.'<br>'.$nj.'<br><br>';
  
//-8.19 
 //  $ret="\n\n学号: ".$xh."\n姓名: ".$xm."\n准考证号:\n".$zkz."\n级别: ".$jb."\n校区: ".$xq."\n院系名称:\n".$yx."\n班级名称:\n".$bj."\n\n";
 // echo $ret;  
  //8.19
 $ret="\n\n"."\n姓名: ".$xm."\n准考证号:\n".$zkzh."\n";
  echo $ret;
  $cet=get_ours_cet($zkzh,$xm);
 $ret=get_utf8_string($cet);
 echo strip_tags($ret);
//8.19
// echo "\n\n网页查询戳 >>\n\nhttp://t.cn/8F8LzGs";
 //8.19
?>





<?php
function get_utf8_string($content) 
{    
	//  将一些字符转化成utf8格式   
	$encoding = mb_detect_encoding($content, array('ASCII','UTF-8','GB2312','GBK','BIG5'));  
	return  mb_convert_encoding($content, 'utf-8', $encoding);
}

//查四六级  
function get_ours_cet($zkzh,$xm)
	{    				
        $url = 'http://av.jejeso.com/helper/api/ours/cet.php?zkzh='.$zkzh.'&xm='.$xm;		
		$result= file_get_contents($url);
		return $result;   
	}

?>