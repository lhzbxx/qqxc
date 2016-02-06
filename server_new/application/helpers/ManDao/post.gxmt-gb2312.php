<?PHP 
//该demo的功能是给不同的手机号发不同的内容,短信的内容里有英文的逗号，参考此demo
$flag = 0; 
        //要post的数据 
$argv = array( 
         'sn'=>'SDK-OFT-010-xxxxx', //提供的账号
		'pwd'=>strtoupper(md5('SDK-OFT-010-xxxxxx'.'xxxxxx')), //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
		 'mobile'=>'153****5051,153****8585,137****1021',//手机号 多个用英文的逗号隔开 一次小于1000个手机号
		 'content'=>urlencode('测试1').','.urlencode('策划i').','.urlencode('测试2'),//多个内容分别urlencode编码然后逗号隔开
		 'ext'=>'',//子号(可以空 ,可以是1个 可以是多个,多个的需要和内容和手机号一一对应)
		 'stime'=>'',//定时时间 格式为2011-6-29 11:09:21
		 'rrid'=>''
		 ); 
//构造要post的字符串 
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
         $header = "POST /webservice.asmx/gxmt HTTP/1.1\r\n"; 
         $header .= "Host:sdk2.entinfo.cn\r\n"; 
         $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
         $header .= "Content-Length: ".$length."\r\n"; 
         $header .= "Connection: Close\r\n\r\n"; 
         //添加post的字符串 
         $header .= $params."\r\n"; 
         //发送post的数据 
         fputs($fp,$header); 
         $inheader = 1; 
          while (!feof($fp)) { 
                         $line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据 
                         if ($inheader && ($line == "\n" || $line == "\r\n")) { 
                                 $inheader = 0; 
                          } 
                          if ($inheader == 0) { 
                                // echo $line; 
                          } 
          } 
		  //<string xmlns="http://tempuri.org/">-5</string>
	       $line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
	       $line=str_replace("</string>","",$line);
		   $result=explode("-",$line);
		    if(count($result)>1)
			echo '发送失败返回值为:'.$line.'。请查看webservice返回值对照表';
			else
			echo '发送成功 返回值为:'.$line; 
?>