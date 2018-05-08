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
## 2. 民工登陆（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=login
### 接口参数
| key        | value   |
| :------:   | :-----: |
| type       | 1       |
| phone      | 1332222222 |
| password   | abcdef    |
### 说明
* type固定值为1  
### 返回值
#### 成功，返回id和token，status=1
```
{
  "code": 0,
  "data": {
    "id": "1",
    "status": 1,
    "token": "66e174c1d373db83b3c501b6b3d610a2"
  }
}
```
#### 手机号未被注册，status=0
```
{
  "code": 0,
  "data": {
    "status": 0
  }
}
```
#### 密码错误，status=-1
```
{
  "code": 0,
  "data": {
    "status": -1
  }
}
```
