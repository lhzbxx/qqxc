<?PHP 
//��demo�Ĺ�����ȡ�ͻ������У����ظ���Ϣ
$flag = 0; 
        //Ҫpost������ 
$argv = array( 
         'sn'=>'SDK-OFT-010-xxxxx', ////�滻�����Լ������к�
		 'pwd'=>strtoupper(md5('SDK-OFT-010-xxxxx'.'xxxxxx')) //�˴�������Ҫ���� ���ܷ�ʽΪ md5(sn+password) 32λ��д
		 ); 
//����Ҫpost���ַ��� 
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
                 //����socket���� 
         $fp = fsockopen("sdk2.entinfo.cn",8060,$errno,$errstr,10) or exit($errstr."--->".$errno); 
         //����post�����ͷ 
         $header = "POST /webservice.asmx/mo HTTP/1.1\r\n"; 
         $header .= "Host:sdk2.entinfo.cn\r\n"; 
         $header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
         $header .= "Content-Length: ".$length."\r\n"; 
         $header .= "Connection: Close\r\n\r\n"; 
         //���post���ַ��� 
         $header .= $params."\r\n"; 
         //����post������ 
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

	// echo $line; exit;//���е��Դ����ã�ֱ����ʾmo�ķ���ֵ�������κδ���
	// for( $i = 0; $i < count( explode("\n",$line) ) ;$i++)

if($line=="1")
{
echo "����ֵ��1������������";
exit;
}
//�Ȱ��� \n �ѻظ������ݲ�ɶ���
$reply_arr=explode("\n",$line);

	$num=count($reply_arr);

 $y=1;
 for( $i = 0; $i <$num ;$i++)
	 {
		//�ٰ��հ�Ƕ��ţ���һ�����ŵ�ÿһ������
	   $reply=explode(",",$reply_arr[$i]);
	   echo "��".$y."��<br />";
echo  "<b>�ظ���</b>".$reply[1]."<br />";
echo  "<b>�ظ��ˣ�</b>".$reply[2]."<br />";
echo  "<b>�ظ����ݣ�</b>".urldecode($reply[3])."<br />";
$time = substr( $reply[4] , 0 , 19 );
echo  "<b>�ظ�ʱ�䣺</b>".$time."<br /><br /><br /><br />";
$y++;
	 }
	
	?>