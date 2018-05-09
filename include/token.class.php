<?php

class Token {

    /**
     * 通过token获取uid
     *
     * @param  $token
     * @return 成功返回uid 失败返回小于一的数
     */
    public static function userid($token){
        global $db;
        $addTime = 60*60*60;
        $re = $db->get('token',[
            'userid',
            'expire'
        ],[
            "tokenName" => $token
        ]);

        if(!$re) {
            return 0;
        } else if($re['expire'] < time()){
            $db->delete('token',[
                "tokenName" => $token
            ]);
            return -1;//-1为过期
        } else {
            $db->update('token',[
                'expire[+]' => "{$addTime}"
            ],[
                "tokenName" => $token
            ]);//延迟过期时间
            return $re['userid'];
        }
    
    }

    /**
     * 添加一个token
     *
     * @param [int] $uid
     * @param [int] 过期时间 默认为60分钟
     * @return token名
     */
    public static function addToken($type, $uid, $expireTime = 60*60) {
        global $db;
        $tokenSalt = '工作记录';
        $tokenName = md5($tokenSalt . time() . $uid . $tokenSalt.$type);
        $db->delete('token',[               //删除之前token
            'userid' => $uid,
            'type' => $type
        ]);
        $db->insert('token',[               //插入最新token
            'userid' => $uid,
            'tokenName' => $tokenName,
            'type' => $type,
            'expire' => time() + $expireTime
        ]);

        return $tokenName;
    }

    /**
     * 删除一个token
     *
     * @param integer $uid 传入要删除的token对应的uid 优先于token值
     * @param integer $token 传入要删除的token 只有在不传入uid的时候起效
     * @return void
     */
    public static function deleteToken($uid = -1, $token = -1,$type) {
        global $db;

        if($uid != -1) {
            $db->delete('token',[
                'type' => $type,
                'userid' => $uid
            ]);
        } else {
            $db->delete('token',[
                'type' => $type,
                'tokenName' => token
            ]);
        }
    }
}
