# API_一般规则

版本：`1.0`

作者：`鲁浩`

日期：`2016.1.28`

### 统一格式：

* 状态码

    |状态码|含义|
    |---|---|
    |100|正常|
    |201|headers缺失|
    |202|缺少参数|
    |203|无效apikey|
    |204|无效接口|
    |205|过多请求|
    |206|过期版本|
    |207|校验失败|
    |208|过期请求|
    |209|权限不足|
    |210|操作失败|
    |3XX|具体API定义|
    |4XX|一般参数错误|

* 返回格式

    ```
    {
        code: '100',
        msg: 'OK',
        data: [
            '1',
            '2',
            '3'
        ]
    }
    ```

    ```
    {
        code: '100',
        msg: 'OK',
        data: ''
    }
    ```

    ```
    {
        code: '100',
        msg: 'OK',
        data: [
            {
                'name': '1',
                'number': 1,
                'like': True
            },
            {
                'name': '2',
                'number': 2,
                'like': True
            },
            {
                'name': '3',
                'number': 3,
                'like': True
            }
        ]
    }
    ```

* 请求格式

    ```
    {
        ...
        method: 'GET',
        apikey: 'xxx',
        apiver: 1
        ...
        params {
            'lat': 1,
            'lng': 1
        }
    }
    ```

* URL

    /API/[platform]/[version]/[controller]/[function]
