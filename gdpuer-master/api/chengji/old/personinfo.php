<?php
ini_set("display_errors", 0);
header("Content-type: text/html; charset=utf-8");
//include("db.config.php");

$xh = $_GET['xh'];
$pw = $_GET['pw'];

//�ύ�˺ź����룬���ģ���½
$post_fields 	= '__VIEWSTATE=dDwtNjg3Njk1NzQ3O3Q8O2w8aTwxPjs%2BO2w8dDw7bDxpPDg%2BO2k8MTM%2BO2k8MTU%2BOz47bDx0PHA8O3A8bDxvbmNsaWNrOz47bDx3aW5kb3cuY2xvc2UoKVw7Oz4%2BPjs7Pjt0PHA8bDxWaXNpYmxlOz47bDxvPGY%2BOz4%2BOzs%2BO3Q8cDxsPFZpc2libGU7PjtsPG88Zj47Pj47Oz47Pj47Pj47bDxpbWdETDtpbWdUQzs%2BPvpW9bNHRO98aj%2BzEmn77FHqeOjK&tbYHM='.$xh.'&tbPSW='.$pw.'&ddlSF=%D1%A7%C9%FA&imgDL.x=28&imgDL.y=19';
$submit_url 	= 'http://10.50.17.2/default3.aspx';//���ҳ��

$ch = curl_init($submit_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_HEADER,1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
$contents = curl_exec($ch);

preg_match('/Set-Cookie: (.*);/i', $contents, $results);
$cookie = $results[1];
curl_close($ch);

/*
$geturl_xsxx = 'http://10.50.17.2/xsxx.aspx?xh='.$xh;//������Ϣҳ��

 ��ѯѧ��������Ϣ���浽���ݿ�

 ������ƥ����Ϣ
 preg_match("/<span id=\"xm\">(.*)<\/span>/",$string,$xm);
 
 $xh  ѧ��
 $pw  ����
 $xm  ����
 $csrq ��������
 $xb �Ա�
 $mz ����
 $syszd ��Դ���ڵ�
 $sfzh ���֤��
 $rxrq ��ѧ����
 $xymc ѧԺ����
 $zymc רҵ����
 $zyfx רҵ����
 $bjmc �༶����
 $nj �꼶
 $zzmm ������ò
           */

$geturl_xsxx = 'http://10.50.17.2/xsxx.aspx?xh='.$xh;//������Ϣҳ��
//$geturl = 'http://10.50.17.2/xscj.aspx?xh='.$xh;
/*
����ͷ
// $header[]='Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, text/html, *'.'/*';
// $header[]='Accept-Language: zh-cn';
// $header[]='User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727)';
// $header[]='Host: 10.50.17.2';
// $header[]='Connection: Keep-Alive';
*/


$header[]='Cookie:'.$cookie;

$ch = curl_init($geturl_xsxx);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch, CURLOPT_HEADER, 0);

$string = curl_exec($ch);//�������
$string=get_utf8_string($string);//ת��utf8

//ƥ������
preg_match("/<span id=\"xm\">(.*)<\/span>/",$string,$xm);
$xm=$xm[1];
$xm=get_utf8_string($xm);

//ƥ���������
preg_match("/<span id=\"csrq\">(.*)<\/span>/",$string,$csrq);
$csrq=$csrq[1];
$csrq=get_utf8_string($csrq);

//ƥ���Ա�
preg_match("/<span id=\"xb\">(.*)<\/span>/",$string,$xb);
$xb=$xb[1];
$xb=get_utf8_string($xb);

//ƥ����ѧ����
preg_match("/<span id=\"rxrq\">(.*)<\/span>/",$string,$rxrq);
$rxrq=$rxrq[1];
$rxrq=get_utf8_string($rxrq);

//ƥ������
preg_match("/<span id=\"mz\">(.*)<\/span>/",$string,$mz);
$mz=$mz[1];
$mz=get_utf8_string($mz);

//ƥ��ѧԺ
preg_match("/<span id=\"xymc\">(.*)<\/span>/",$string,$xymc);
$xymc=$xymc[1];
$xymc=get_utf8_string($xymc);

//ƥ��רҵ����
preg_match("/<span id=\"zymc\">(.*)<\/span>/",$string,$zymc);
$zymc=$zymc[1];
$zymc=get_utf8_string($zymc);

//ƥ��רҵ����
preg_match("/<span id=\"zyfx\">(.*)<\/span>/",$string,$zyfx);
$zyfx=$zyfx[1];
$zyfx=get_utf8_string($zyfx);

//ƥ��༶����
preg_match("/<span id=\"bjmc\">(.*)<\/span>/",$string,$bjmc);
$bjmc=$bjmc[1];
$bjmc=get_utf8_string($bjmc);

//ƥ�����֤��
preg_match("/<span id=\"sfzh\">(.*)<\/span>/",$string,$sfzh);
$sfzh=$sfzh[1];
$sfzh=get_utf8_string($sfzh);

//ƥ���꼶
preg_match("/<span id=\"dqszj\">(.*)<\/span>/",$string,$nj);
$nj=$nj[1];
$nj=get_utf8_string($nj);

//ƥ����Դ���ڵ�
preg_match("/<span id=\"syszd\">(.*)<\/span>/",$string,$syszd);
$syszd=$syszd[1];
$syszd=get_utf8_string($syszd);

//ƥ��������ò
preg_match("/<span id=\"zzmm\">(.*)<\/span>/",$string,$zzmm);
$zzmm=$zzmm[1];
$zzmm=get_utf8_string($zzmm);

//echo $pw.$xm.$csrq.$xb.$mz.$syszd.$sfzh.$rxrq.$xymc.$zymc.$zyfx.$bjmc.$nj.$zzmm;
if($xm){


$ret=$xm."<br>".$xymc."<br>".$bjmc."<br><br>";
 echo $ret;
{
      $dbname = 'jwc';//������д���ݿ������
 
       /*�ӻ���������ȡ�����ݿ�������Ҫ�Ĳ���*/
       $host = '10.5.20.40';
       //$port ='' ;//�˿ں�
       $user = 'jwcinfo';
       $pwd = 'jwcxinxi';
 
       /*���ŵ���mysql_connect()���ӷ�����*/
       $link = @mysql_connect("{$host}",$user,$pwd,true);
       if(!$link) {
                   @post_db($xh,$pw,$xm,$csrq,$xb,$mz,$syszd,$sfzh,$rxrq,$xymc,$zymc,$zyfx,$bjmc,$nj,$zzmm);
				   die(get_utf8_string("������ Yanson & Anywill" ));
                  }
       /*���ӳɹ�����������mysql_select_db()ѡ����Ҫ���ӵ����ݿ�*/
       if(!mysql_select_db($dbname,$link)) {
					@post_db($xh,$pw,$xm,$csrq,$xb,$mz,$syszd,$sfzh,$rxrq,$xymc,$zymc,$zyfx,$bjmc,$nj,$zzmm);
                   die(get_utf8_string("������  Anywill & Yanson "));
                  }
		
//�����������ݿ�
}


$sql_personinfo="REPLACE INTO  `personinfo` (`xh` ,`pwd` ,`xm` ,`csrq` ,`xb` ,`mz` ,`syszd`,`sfzh` ,`rxrq` ,`xymc` ,`zymc` ,`zyfx` ,`bjmc` ,`nj` ,`zzmm`,`time`)VALUES ('{$xh}' ,'{$pw}' ,'{$xm}' ,'{$csrq}' ,'{$xb}' ,'{$mz}' ,'{$syszd}','{$sfzh}' ,'{$rxrq}' ,'{$xymc}' ,'{$zymc}' ,'{$zyfx}' ,'{$bjmc}' ,'{$nj}' ,'{$zzmm}',TIMESTAMP(10))";
$query_char=mysql_query("SET NAMES UTF8");
$query_personinfo=mysql_query($sql_personinfo,$link) or die(mysql_error());

post_db($xh,$pw,$xm,$csrq,$xb,$mz,$syszd,$sfzh,$rxrq,$xymc,$zymc,$zyfx,$bjmc,$nj,$zzmm);
 

 
 
 
 }else{
 echo get_utf8_string("��ȡʧ��...");
 }
function get_utf8_string($content) 
	{    	  
		$encoding = mb_detect_encoding($content, array('ASCII','UTF-8','GB2312','GBK','BIG5'));  
		return  mb_convert_encoding($content, 'utf-8', $encoding);
	}
function post_db($xh,$pw,$xm,$csrq,$xb,$mz,$syszd,$sfzh,$rxrq,$xymc,$zymc,$zyfx,$bjmc,$nj,$zzmm) 
	{    	  
		$api_url='http://ourstudio.duapp.com/jwc/dbapi.php?xh='.$xh.'&pw='.$pw.'&xm='.$xm.'&csrq='.$csrq.'&xb='.$xb.'&mz='.$mz.'&syszd='.$syszd.'&sfzh='.$sfzh.'&rxrq='.$rxrq.'&xymc='.$xymc.'&zymc='.$zymc.'&zyfx='.$zyfx.'&bjmc='.$bjmc.'&nj='.$nj.'&zzmm='.$zzmm;
		$ret_personinfo=file_get_contents($api_url);
		return $ret_personinfo;
		
	}
	
	
?>