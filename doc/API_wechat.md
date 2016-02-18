# API_微信端

版本：`1.0`

作者：`鲁浩`

日期：`2016.1.28`

* 前缀

	http://120.27.194.121/index.php/API/wx/[version]

* 具体接口

	* 提交邀请码
	
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/coupon/submit_code|提交邀请码|post|1|
	
		请求示例:
		
		```
		{
			apikey: '',
			code: ''
		}
		```
	
	    |特殊状态码|含义|
   		|---|---|
   		|301|无效邀请码|
    
    	返回示例:
    	
    	```
    	{
        	code: '100',
        	msg: 'OK',
        	data: ''
    	}
    	```

    	```
    	{
        	code: '301',
        	msg: 'invalid code',
        	data: ''
    	}
    	```
	* 查看邀请码
	
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/coupon/check_code|查看邀请码|get|1|
	
		请求示例:
		
		```
		{
			apikey: ''
		}
		```
	
	    |特殊状态码|含义|
   		|---|---|
   		|301|无效邀请码|
    
    	返回示例:
    	
    	```
    	{
        	code: '100',
        	msg: 'OK',
        	data: 'invite_code'
    	}
    	```
    	
    * 请求验证码
    
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/request_verify_code|请求验证码|post|1|
		
		|参数|说明|可否为空|
		| - | - | - |
		|phone|手机号|否|
		
		请求示例：
		
		```
		{
			openid: '',
			phone: '',
			verify_code: '',
			password: '',
			name: ''
		}
		```
   		
	    |特殊状态码|含义|
   		|---|---|
   		|301|验证码错误|
   		|302|手机号格式错误|
   		|303|手机号已绑定|
   		|304|密码格式错误|
   		|305|无效openid|
   		
   		返回示例：
   		
    	```
    	{
        	code: '100',
        	msg: 'OK',
        	data: ''
    	}
    	```
    	
    * 绑定手机号
    
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/user/bind_phone|绑定手机号|post|1|
		
		|参数|说明|可否为空|
		| - | - | - |
		|openid|显示的openid|否|
		|phone|手机号|否|
		|verify_code|验证码|否|
		|password|密码（需要经过MD5加密）|否|
		|name|姓名|否|
		
		请求示例：
		
		```
		{
			openid: '',
			phone: '',
			verify_code: '',
			password: '',
			name: ''
		}
		```
   		
	    |特殊状态码|含义|
   		|---|---|
   		|301|验证码错误|
   		|302|手机号格式错误|
   		|303|手机号已绑定|
   		|304|密码格式错误|
   		|305|无效openid|
   		
   		返回示例：
   		
    	```
    	{
        	code: '100',
        	msg: 'OK',
        	data: 'apikey'
    	}
    	```
    	
    * 列出教练
    
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/coach/list|列出教练|get|1|
		
		|参数|说明|可否为空|
		| - | - | - |
		|lat|经度|否|
		|lng|纬度|否|
		|query|排序方式|是|
		|page|页数|是|
		
		请求示例：
		
		```
		{
			lat: '',
			lng: '',
			query: '',
			page: ''
		}
		```
				
   		返回示例：
   		
    	```
    	{
        	code: '100',
        	msg: 'OK',
        	data: [
        		{
        			'name': '',
        			'type': '',
        			'exp': '',
        			'addr': '',
        			'price': '',
        			'dist': '',
        			'avatar': '',
        			'coach_id': ''
        		},
        		{
        			'name': '',
        			'type': '',
        			'exp': '',
        			'addr': '',
        			'price': '',
        			'dist': '',
        			'avatar': '',
        			'coach_id': ''
        		}
        	]
    	}
    	```
    	
    * 教练详情
    
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/coach/detail|教练详情|get|1|
		
		|参数|说明|可否为空|
		| - | - | - |
		|coach_id|教练id|否|
		
		请求示例：
		
		```
		{
			coach_id: ''
		}
		```
		
	    |特殊状态码|含义|
   		|---|---|
   		|301|教练不存在|
				
   		返回示例：
   		
    	```
    	{
        	code: '100',
        	msg: 'OK',
        	data: {
        		'name': '',
        		'type': '',
        		'exp': '',
        		'addr': '',
        		'price': '',
        		'dist': '',
        		'avatar': '',
        		'coach_id': ''
        		'school': '',
        		'place': ''
        	}
    	}
    	```
    	
    * 教练照片
    
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/coach/photo|教练照片|get|1|
		
		|参数|说明|可否为空|
		| - | - | - |
		|coach_id|教练id|否|
		
		请求示例：
		
		```
		{
			coach_id: ''
		}
		```
		
	    |特殊状态码|含义|
   		|---|---|
   		|301|教练不存在|
				
   		返回示例：
   		
    	```
    	{
        	code: '100',
        	msg: 'OK',
        	data: [
				'',
				'',
				''
        	]
    	}
    	```
    	
    * 意见反馈
    
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/feedback|意见反馈|post|1|
		
		|参数|说明|可否为空|
		| - | - | - |
		|content|反馈内容|否|
		|contact|联系方式|是|
		
		请求示例：
		
		```
		{
			content: '',
			contact: ''
		}
		```
		
   		返回示例：
   		
    	```
    	{
        	code: '100',
        	msg: 'OK',
        	data: ''
    	}
    	```
	
	* 查看余额
    
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/account/check_balance|查看余额|get|1|
		
		|参数|说明|可否为空|
		| - | - | - |
		|apikey|apikey|否|
		
		请求示例：
		
		```
		{
			apikey: ''
		}
		```
		
   		返回示例：
   		
    	```
    	{
        	code: '100',
        	msg: 'OK',
        	data: 'balance'
    	}
    	```
	
	* 支付预处理
	
		|URL|说明|方法|版本|
		| - | - | - | - |
		|/pay/pre_deal|支付预处理|post|1|
		
		|参数|说明|可否为空|
		| - | - | - |
		|apikey|apikey|否|
		|coach_id|教练id|否|
		|type|教车类型|否|
	
	* 支付提交
	
	