# api说明
## 1. 民工注册（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=signUp
### 接口参数
| key        | value   |
| :------:   | :-----: |
| type       | 1       |
| name       | 王二    |
| age        |  23      |
| phone      | 1332222222 |
| password   | abcdef    |
| experience | [{"experience":"家装主材安装","year":2},{"experience":"电器安装维修","year":2}]
|
### 说明
* type固定值为1  
* experience为json格式字符串
### 返回值
#### 成功，返回id和token，status=1
```
{
    "code": 0,
    "data": {
        "token": "730043bd775fc1473c0235a18c43a811",
        "status": 1,
        "id": "1"
    }
}
```
#### 手机号已经被注册，status=2
```
{
    "code": 0,
    "data": {
        "status": 2
    }
}
```