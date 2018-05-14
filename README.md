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
## 3. 民工查看工作记录（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=getRecord
### 接口参数
| key        | value   |
| :------:   | :-----: |
| token       | 121212adadasdad      |
### 返回值
#### 成功，返回记录数组
```
{
  "code": 0,
  "data": [
    {
      "work_id": "1",
      "num": "1",
      "date": "20180601",
      "add_time": "1526126055",
      "hash": "0x3ed2bba2c298750ab21b0e069dfd6b0c4470c7d380036b6884381e59d4d6ad90"
    },
    {
      "work_id": "1",
      "num": "1",
      "date": "20180601",
      "add_time": "1526126135",
      "hash": "0x24d94683b96819efcfc20b7f9a32328bf84211c376db8ed0d5c9f4a5b18790dc"
    },
    {
      "work_id": "1",
      "num": "1",
      "date": "20180601",
      "add_time": "1526128876",
      "hash": "16bcfd908c475b20247bff7f43f20c72"
    },
    {
      "work_id": "1",
      "num": "1",
      "date": "20180601",
      "add_time": "1526128906",
      "hash": "0x7df8d9227e6024e7e98066eaa889f732"
    }
  ]
}
```
#### 越权访问
```
{
  "code": 1,
  "msg": "No authority"
}
```
## 4. 查看工作（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=listWork
### 接口参数
| key        | value   |
| :------:   | :-----: |
| type       | 家装主材安装|
| page       | 1|
### 说明
* type为工种类型  
* page为页数，从1开始，默认每页10条数据
### 返回值
#### 成功返回工作数组，finished字段表明是否结束，true则不需要再请求下一页
```
{
  "code": 0,
  "data": {
    "finished": false,
    "work": [
      {
        "task_id": "2",
        "field": "家装主材安装",
        "wage": "100",
        "address": "南京",
        "phone": "13222222",
        "house": "板房",
        "welfare": "高温补贴",
        "start_time": "",
        "company_id": "3",
        "comapny_info": {
          "name": "南京航空航天大学",
          "phone": "13322222223",
          "mail": "8888888@qq.com",
          "address": "南京江宁",
          "number": "91320102716209711G"
        }
      },
      {
        "task_id": "3",
        "field": "家装主材安装",
        "wage": "100",
        "address": "南京",
        "phone": "13222222",
        "house": "板房",
        "welfare": "高温补贴",
        "start_time": "",
        "company_id": "3",
        "comapny_info": {
          "name": "南京航空航天大学",
          "phone": "13322222223",
          "mail": "8888888@qq.com",
          "address": "南京江宁",
          "number": "91320102716209711G"
        }
      },
      {
        "task_id": "4",
        "field": "家装主材安装",
        "wage": "100",
        "address": "南京",
        "phone": "13222222",
        "house": "板房",
        "welfare": "高温补贴",
        "start_time": "",
        "company_id": "3",
        "comapny_info": {
          "name": "南京航空航天大学",
          "phone": "13322222223",
          "mail": "8888888@qq.com",
          "address": "南京江宁",
          "number": "91320102716209711G"
        }
      }
    ]
  }
}
```
## 5. 申请工作（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=applyJob
### 接口参数
| key        | value   |
| :------:   | :-----: |
| work_id       | 1|
| token       | 998asjasjajsj|
### 说明
* work_id为申请的工作id  
### 返回值
#### 申请成功,status为1
```
{
  "code": 0,
  "data": {
    "status": 1
  }
}
```
#### 重复申请,status为-1
```
{
  "code": 0,
  "data": {
    "status": -1
  }
}
```
## 6. 查看自己申请的工作（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=listApplyJob
### 接口参数
| key        | value   |
| :------:   | :-----: |
| token       | 12kjajdjkadjkajkd|
| page       | 1|
### 说明
* page为页数，从1开始，默认每页10条数据
### 返回值
#### 成功返回工作数组，finished字段表明是否结束，true则不需要再请求下一页，按时间从大到小排序。  
status：0：已申请，1：公司录用，-1：公司拒绝。
```
{
  "code": 0,
  "data": {
    "finished": true,
    "apply_work": [
      {
        "work_id": "3",
        "status": "0",
        "add_time": "1526295656",
        "task_info": {
          "address": "南京",
          "phone": "13222222",
          "house": "板房",
          "welfare": "高温补贴",
          "start_time": "",
          "company_id": "3"
        }
      },
      {
        "work_id": "2",
        "status": "0",
        "add_time": "1526295635",
        "task_info": {
          "address": "南京",
          "phone": "13222222",
          "house": "板房",
          "welfare": "高温补贴",
          "start_time": "",
          "company_id": "3"
        }
      }
    ]
  }
}
```
## 2. 公司登陆（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=login
### 接口参数
| key        | value   |
| :------:   | :-----: |
| type       | 0       |
| number      | 91320102716209711G |
| password   | abcdef    |
### 说明
* type固定值为0  
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
#### 未被注册，status=0
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
## 3. 公司发布工作（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=releaseWork
### 接口参数
| key        | value   |
| :------:   | :-----: |
| token       | e6971f7a692cbaa8b37aa7ad32875aaf       |
|address|南京|
|phone|13222222|
|wages|[{"type":"家装主材安装","wage":100},{"type":"电器安装维修","wage":110}]|
|house|板房|
|welfare|高温补贴|
|start_time|20180611|
### 说明
* wages为招聘工种和对应工资  
* house为住房条件
* welfare为福利   
* start_time开始时间
### 返回值
#### 成功，status=1
```
{
    "code": 0,
    "data": {
        "status": 1
    }
}
```
## 4. 记录工时（get）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=addRecord
### 接口参数
| key        | value   |
| :------:   | :-----: |
|   id     | 1 |
|date|20180601|
|num|10|
|work_id|1|
|token|121212hashajsjajsj|
### 说明
* id为工人id号
* date为工作日期，8位
* num工时数  
* work_id工作id
### 返回值
#### 成功，返回交易hash值
```
{
    "code": 0,
    "data":0x7df8d9227e6024e7e98066eaa889f732
}
```
