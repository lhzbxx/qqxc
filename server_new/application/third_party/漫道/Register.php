<?PHP 
//该demo的功能是注册序列号。注意序列号只需注册一次，即可使用。
//如果您的系统是UTF-8。请转成GB2312后，再提交。否则，可能会乱码
//参考代码：iconv( "UTF-8", "gb2312//IGNORE" ,"你好，测试短信")
$flag = 0; 
        //要post的数据 
$argv = array( 
'sn'=>'SDK-OFT-010-xxxxx', //?????
 'pwd'=>'xueche', //?????6????????????? ????? md5(sn+password) 32???????????????
 'province'=> '???',//?????????
 'city'=>'???',//????????
 'trade'=>'???',//??????
 'entname'=>'????',//??????
 'linkman'=>'???',//?????
 'phone'=>'88888888',//????????
 'mobile'=>'13162570221',//??
 'email'=>'daiwenbo@laixc.net',//????
 'fax'=>'',//??
 'address'=>'??????????',//????
 'postcode'=>'200240',//??
 'sign'=>'',//????????????
   );
//构造要post的字符串 
foreach ($argv as $key=>$value) { 
          if ($flag!=0) { 
                         $params .= "&"; 
                         $flag = 1; 
          } 
$params = '';
         $params.= $key."="; $params.= urlencode($value); 
         $flag = 1; 
          } 
         $length = strlen($params); 
                 //创建socket连接 
        $fp = fsockopen("sdk2.entinfo.cn",80,$errno,$errstr,10) or exit($errstr."--->".$errno); 
         //构造post请求的头 
         $header = "POST /webservice.asmx/Register HTTP/1.1\r\n"; 
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
		   $result=explode(" ",$line);
		   //print_r( $result);
		if  ( $result[0]=="0")
echo "注册成功！";
if ($result[0]=="-1")
echo "重复注册";
		
?>