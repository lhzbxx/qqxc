<?PHP 
//��demo�Ĺ����Ǹ���ͬ���ֻ��ŷ���ͬ������,���ŵ���������Ӣ�ĵĶ��ţ��ο���demo
$flag = 0; 
        //Ҫpost������ 
$argv = array( 
         'sn'=>'SDK-OFT-010-xxxxx', //�ṩ���˺�
		'pwd'=>strtoupper(md5('SDK-OFT-010-xxxxxx'.'xxxxxx')), //�˴�������Ҫ���� ���ܷ�ʽΪ md5(sn+password) 32λ��д
		 'mobile'=>'153****5051,153****8585,137****1021',//�ֻ��� �����Ӣ�ĵĶ��Ÿ��� һ��С��1000���ֻ���
		 'content'=>urlencode('����1').','.urlencode('�߻�i').','.urlencode('����2'),//������ݷֱ�urlencode����Ȼ�󶺺Ÿ���
		 'ext'=>'',//�Ӻ�(���Կ� ,������1�� �����Ƕ��,�������Ҫ�����ݺ��ֻ���һһ��Ӧ)
		 'stime'=>'',//��ʱʱ�� ��ʽΪ2011-6-29 11:09:21
		 'rrid'=>''
		 ); 
//����Ҫpost���ַ��� 
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
         $header = "POST /webservice.asmx/gxmt HTTP/1.1\r\n"; 
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
		   $result=explode("-",$line);
		    if(count($result)>1)
			echo '����ʧ�ܷ���ֵΪ:'.$line.'����鿴webservice����ֵ���ձ�';
			else
			echo '���ͳɹ� ����ֵΪ:'.$line; 
?>