# api说明
# 民工接口
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
# 公司接口
## 1. 公司注册（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=signUp
### 接口参数
| key        | value   |
| :------:   | :-----: |
| type       | 0       |
| name       | 南京航空航天大学    |
| phone      | 1332222222 |
| mail       |    8888888@qq.com  |
|address|南京江宁|
|number|91320102716209811G|
| password   | abcdef    |
### 说明
* type固定值为0
### 返回值
#### 成功，返回id和token，status=1
```
{
    "code": 0,
    "data": {
        "token": "e6971f7a692cbaa8b37aa7ad32875aaf",
        "status": 1,
        "id": "1"
    }
}
```
#### 已经被注册，status=2
```
{
    "code": 0,
    "data": {
        "status": 2
    }
}
```