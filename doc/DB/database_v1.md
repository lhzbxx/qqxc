#数据库的字段和说明

@author: `LuHao`

@date: `2015-12-01`

@Version: `1.0`

----------

### User

`用户表`

| Fields | Description |
| ------------- | ------------- |
| id | 编号。 |
| nickname | 用户昵称，默认是“其乐XXXXXX”，与微信OpendID绑定后更换为用户的微信昵称。 |
| phone_number | 用户的唯一标识，保证其唯一性。 |
| password | 用户密码，其结果是md5(salt+md5(password))，并不是用户初始设置的密码。 |
| salt | 用户的密码盐，在用户注册的时候随机生成。 |
| register_time | 用户的注册时间，时间戳。 |
| avatar | 用户的头像url地址。 |
| true_name | 用户的真实姓名，作为一条额外的信息，不作为任何显示或检查的数据。 |
| weixin_openid | 用户的微信的OpenID，保存后方便读取，而不需要再次进行授权，以加速下一次的微信支付操作。 |

### User_info

`用户信息表`

| Fields | Description |
| ------------- | ------------- |
| user_id | 用户的编号，外键。 |
| check_time | 用户上次进行检查的时间。 |
| openid | 用户分配的openid，系统配给的UUID。 |
| expire | 用户的openid的有效时间。 |


### Coach

`用户信息表`

| Fields | Description |
| ------------- | ------------- |
| user_id | 用户的编号，外键。 |
| check_time | 用户上次进行检查的时间。 |
| openid | 用户分配的openid，系统配给的UUID。 |
| expire | 用户的openid的有效时间。 |

