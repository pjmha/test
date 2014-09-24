<?php
	$content = $this->message['content'];
	$content=strtolower($content);
	$from_user=$this->message['from'];
	$sql = "SELECT * FROM " . tablename('stu_profile') . " WHERE `from_user`=:from_user LIMIT 1";
	$row_info = pdo_fetch($sql, array(':from_user' => $from_user));
	if($content=='退出' || $content=='取消'){
		$this->endContext();
		return $this->respText("你已经退出本模式");
	}
	
	if (empty($row_info['xh'])) {
	
			$content=str_replace('＃','#',$content);
			$ret=explode('#',$content);
			$xh=$ret[1];
			$pw=$ret[2];
			$day=date("w");
			if(isset($ret[3])){
			if(($ret[3]>=1)&&($ret[3]<=5))
			{
			$day=$ret[3];
			}
			if((strtolower($ret[3])=='all'))
			{
			$day='all';
			}
			}
			if(($xh)&&($pw)){
				$url = 'http://ours.123nat.com:59832/kb/kb.php?xh='.$xh.'&pw='.$pw.'&day='.$day;	
				$content= file_get_contents($url);
			}elseif((!$xh)||(!$pw)){
				$content="【现已支持所有校区】\n按照以下格式获取课表\n\n【今天课表】\n课表#学号#密码\n\n【周X课表】\n课表#学号#密码#X\n\n(X为1-5,或者是all，否则均默认为当天，周六、日显示全部课表)\n\n【例如】\n获取今天课表：\n课表#1207511199#1207511199\n\n获取周1课表：\n课表#1207511199#1207511199#1\n\n获取全部课表：\n课表#1207511199#1207511199#all\n\n【绑定之后】\n【今天课表】\n课表\n【周X课表】\n课表X\n\n想直接快速查询请先回复\n\n绑定\n\n进行【绑定】";
			}else{
				$content="【现已支持所有校区】\n按照以下格式获取课表\n\n【今天课表】\n课表#学号#密码\n\n【周X课表】\n课表#学号#密码#X\n\n(X为1-5,或者是all，否则均默认为当天，周六、日显示全部课表)\n\n【例如】\n获取今天课表：\n课表#1207511199#1207511199\n\n获取周1课表：\n课表#1207511199#1207511199#1\n\n获取全部课表：\n课表#1207511199#1207511199#all\n\n【绑定之后】\n【今天课表】\n课表\n【周X课表】\n课表X\n\n想直接快速查询请先回复\n\n绑定\n\n进行【绑定】";
			}
	
		return $this->respText($content);

	}else{
	
		$xh=$row_info['xh'];
		$pw=$row_info['jwcpwd'];
		if(strstr($content,"课表")){
		$ret[3]=ltrim($content,"课表");
		}
		
		if(strstr($content,"kb")){
		$ret[3]=ltrim($content,"kb");
		}
		$day=date("w");
			if(isset($ret[3])){
			if(($ret[3]>=1)&&($ret[3]<=5))
			{
			$day=$ret[3];
			}
			if((strtolower($ret[3])=='all'))
			{
			$day='all';
			}
			}
			if(($xh)&&($pw)){
				$url = 'http://ours.123nat.com:59832/kb/kb.php?xh='.$xh.'&pw='.$pw.'&day='.$day;	
				$content= file_get_contents($url);
			}elseif((!$xh)||(!$pw)){
				$content="【现已支持所有校区】\n按照以下格式获取课表\n\n【今天课表】\n课表\n\n【周X课表】\n课表X\n\n(X为1-5,或者是all，否则均默认为当天，周六、日显示全部课表)\n\n【例如】\n获取今天课表：\n课表\n\n获取周1课表：\n课表1\n\n获取全部课表：\n课表all";
			}else{
				$content="【现已支持所有校区】\n按照以下格式获取课表\n\n【今天课表】\n课表\n\n【周X课表】\n课表X\n\n(X为1-5,或者是all，否则均默认为当天，周六、日显示全部课表)\n\n【例如】\n获取今天课表：\n课表\n\n获取周1课表：\n课表1\n\n获取全部课表：\n课表all";
			}
		return $this->respText($content);
	}
	
	
	
	

	function get_utf8_string($content) 
	{    	  
		$encoding = mb_detect_encoding($content, array('ASCII','UTF-8','GB2312','GBK','BIG5'));  
		return  mb_convert_encoding($content, 'utf-8', $encoding);
	}
	

		?>