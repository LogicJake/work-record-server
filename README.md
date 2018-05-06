# api说明
## 1. 民工注册（post）
### 接口地址
http://api.logicjake.xyz/work-record/?_action=signUp
### 接口参数
| key        | value   |
| :------:   | :-----: |
| type       | 1       |
| name       | 王二    |
| age        | 23      |
| phone      | 1332222222 |
| password   | abcdef    |
| experience | 瓦工(10),水泥工(2)|
### 说明
* type固定值为1  
* experience为工种经验，括号（为英文括号）中为对应从业时长，多个用英文逗号连接
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