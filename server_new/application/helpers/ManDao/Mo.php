<?PHP 
//该demo的功能是取客户的上行，即回复信息
$flag = 0; 
        //要post的数据 
$argv = array( 
         'sn'=>'SDK-OFT-010-xxxxx', ////替换成您自己的序列号
		 'pwd'=>strtoupper(md5('SDK-OFT-010-xxxxx'.'xxxxxx')) //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
		 ); 
//构造要post的字符串 
$params='';
foreach ($argv as $key=>$value) { 
          if ($flag!=0) { 
                         $params .= "&"; 
                         $flag = 1; 
          } 
         $params.= $key."="; $params.=urlencode($value); 
         $flag = 1; 
          } 
         $length = strlen($params); 
                 //创建socket连接 
         $fp = fsockopen("sdk2.entinfo.cn",8060,$errno,$errstr,10) or exit($errstr."--->".$errno); 
         //构造post请求的头 
         $header = "POST /webservice.asmx/mo HTTP/1.1\r\n"; 
         $header .= "Host:sdk2.entinfo.cn\r\n"; 
         $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
         $header .= "Content-Length: ".$length."\r\n"; 
         $header .= "Connection: Close\r\n\r\n"; 
         //添加post的字符串 
         $header .= $params."\r\n"; 
         //发送post的数据 
		 $line='';
         fputs($fp,$header); 
         while(!feof($fp)){			
			 $line .= fgets($fp,1024);

		  }	  list(,$line)=explode("\r\n\r\n",$line,2);
	  //<string xmlns="http://tempuri.org/">-5</string>
	 $line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
	 $line=str_replace("</string>","",$line);
	 $line=preg_replace('/<[^>]*?>/','',$line);
	 $line=trim($line);

	// echo $line; exit;//该行调试代码用，直接显示mo的返回值，不做任何处理
	// for( $i = 0; $i < count( explode("\n",$line) ) ;$i++)

if($line=="1")
{
echo "返回值是1，无上行内容";
exit;
}
//先按照 \n 把回复的内容拆成多条
$reply_arr=explode("\n",$line);

	$num=count($reply_arr);

 $y=1;
 for( $i = 0; $i <$num ;$i++)
	 {
		//再按照半角逗号，把一条短信的每一项拆出来
	   $reply=explode(",",$reply_arr[$i]);
	   echo "第".$y."条<br />";
echo  "<b>回复：</b>".$reply[1]."<br />";
echo  "<b>回复人：</b>".$reply[2]."<br />";
echo  "<b>回复内容：</b>".urldecode($reply[3])."<br />";
$time = substr( $reply[4] , 0 , 19 );
echo  "<b>回复时间：</b>".$time."<br /><br /><br /><br />";
$y++;
	 }
	
	?>