<?PHP 
//��demo�Ĺ�����ע�����кš�ע�����к�ֻ��ע��һ�Σ�����ʹ�á�
//�������ϵͳ��UTF-8����ת��GB2312�����ύ�����򣬿��ܻ�����
//�ο����룺iconv( "UTF-8", "gb2312//IGNORE" ,"��ã����Զ���")
$flag = 0; 
        //Ҫpost������ 
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
//����Ҫpost���ַ��� 
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
                 //����socket���� 
        $fp = fsockopen("sdk2.entinfo.cn",80,$errno,$errstr,10) or exit($errstr."--->".$errno); 
         //����post�����ͷ 
         $header = "POST /webservice.asmx/Register HTTP/1.1\r\n"; 
         $header .= "Host:sdk2.entinfo.cn\r\n"; 
          $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
         $header .= "Content-Length: ".$length."\r\n"; 
         $header .= "Connection: Close\r\n\r\n"; 
         //���post���ַ��� 
         $header .= $params."\r\n"; 
         //����post������ 
         fputs($fp,$header); 
         $inheader = 1; 
          while (!feof($fp)) { 
                         $line = fgets($fp,1024); //ȥ���������ͷֻ��ʾҳ��ķ������� 
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
echo "ע��ɹ���";
if ($result[0]=="-1")
echo "�ظ�ע��";
		
?>