# CodeIgniter架构说明

版本：`1.0`

作者：`鲁浩`

日期：`2016.1.29`

### 统一格式：

* Controller

	分为API_Controller和CLI_Controller，主要目的是区分网络请求和本地请求。
	
	网络请求应对主要业务，本地请求用于定时任务和临时修改。
	
	此外，一些第三方服务需要回调服务器的时候，则请求默认的CI_Controller。
	
* API_Controller
	
	* 请求的参数和返回的参数均为JSON格式。
	
	* 版本号
	
		每一个API都有特定的版本号，需要在Header中说明版本号。
		
	* apikey
	
		当涉及到用户状态的操作时候，需要在Header中提供apikey。而apikey在用户登录的时候生成，作为一个键值对存储在缓存服务器（Redis）中，所以如果一个API是状态相关的操作，则在请求的时候检查apikey，如果apikey无效（包含过期），则直接返回错误。
		
		`注意：`apikey需要客户端自行处理存储和注销。
		
	* URL

	    /API/[platform]/[version]/[controller]/[function]

		例如：
		
			/API/wx/1/coach/list

* CLI_Controller

	* 作为定时任务和临时修改的响应接口。
	
	* 没有硬性的要求，自由发挥。
	
	* 可能存在越过权限的操作。
		
* Hook

	* blacklist
	
		黑名单机制
	
	* log
	
		日志监控，对超时API调用发出警告。
	
	* validation
	
		* 参数的验证
			
			所有的Controller所需要的函数都在config中预先说明。
		
		* api_key验证
		
		* 时间戳和签名的校验
		
			微信中跳过了这个步骤。
			
		* 权限检查
		
			对admin的请求进行检查权限。
	
* library

	* Param_validation
	
		参数验证的调用在Controller中实现。
		
		具体如何验证在该library中实现。
	
	* APIkey & Captcha
	
		道理相同，使用Redis，利用prefix+序列的key获取value。
		
	* Result
	
		输出格式。
		
	* Util
	
		工具类，主要是方便调用一些公共接口。
	
