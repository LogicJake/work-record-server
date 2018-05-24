<?php
$address_from = "0x9d81524cd6b6d6600c273615eae83334269c29a1";		//call address
$address_to  = "0x1627239df0790173a497aba52a3e78f7d8e02e22";			//contact address
$ip = "http://localhost";

function to64Hex($data){
	$res = dechex($data);
	$num0 = 64-strlen($res);
	$res0 = "";
	for ($i=0; $i < $num0; $i++)
		$res0 = $res0."0";
	$res = $res0.$res;
	return $res;
}

function addRecord($id,$work_id,$date,$num){
	global $address_from;
	global $address_to;
	global $ip;
	date_default_timezone_set('PRC');
	$add_time=time();
	$data = "0xe042236b".to64Hex($id).to64Hex($work_id).to64Hex($date).to64Hex($num).to64Hex($add_time);

	$params = array();
	$params[0] = array("from" => $address_from,"to" => $address_to,"data" => $data);

	$post_data = array("jsonrpc" => "2.0", "method" => "eth_sendTransaction", "id"=>1, "params"=>$params);
	$post_data = json_encode($post_data);

	$curl = curl_init($ip);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    	'Content-Type: application/json',
    	'Content-Length: ' . strlen($post_data))
	);
	curl_setopt($curl, CURLOPT_PORT, 8545);
	unlockAccount();
	$res = curl_exec($curl);
	curl_close($curl);
	$arr = json_decode($res,true);
	$hash = $arr['result'];

	// $tokenSalt = '工作记录';
	// $hash = "0x".md5($tokenSalt.time().$tokenSalt);

	global $db;
	$db->insert("records",[
		"worker_id" => $id,
		"work_id" => $work_id,
		"num" => $num,
		"date" => $date,
		"add_time" => $add_time,
		"hash" => $hash
		]);

	return $hash;
}

function unlockAccount($time=50){
	global $address_from;
	global $ip;
	$params = array();
	$params[0] = $address_from;
	$params[1] = "123";			//password
	$params[2] = $time;			//unlock time


	$post_data = array("jsonrpc" => "2.0", "method" => "personal_unlockAccount", "id"=>3, "params"=>$params);
	$post_data = json_encode($post_data);

	$curl = curl_init($ip);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    	'Content-Type: application/json',
    	'Content-Length: ' . strlen($post_data))
	);
	curl_setopt($curl, CURLOPT_PORT, 8545);
	$res = curl_exec($curl);
	curl_close($curl);
}

function getRecordsBy2Id($worker_id,$work_id){

	global $address_to;
	global $ip;

	$rdata = array();
	$page = 1;
	$finished = false;
	while(!$finished){
		$data = "0xa61d9c00".to64Hex($worker_id).to64Hex($work_id).to64Hex($page);
		$params = array();
		$params[0] = array("to" => $address_to,"data" => $data);
		$params[1] = "latest";

		$post_data = array("jsonrpc" => "2.0", "method" => "eth_call", "id"=>3, "params"=>$params);
		$post_data = json_encode($post_data);

		$curl = curl_init($ip);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
	    	'Content-Type: application/json',
	    	'Content-Length: ' . strlen($post_data))
		);
		curl_setopt($curl, CURLOPT_PORT, 8545);
		$res = curl_exec($curl);
		curl_close($curl);

		$arr = json_decode($res,true);
		$hash = substr($arr['result'],2);
		if(hexdec(substr($hash,64,64))==1)
			$finished = true;

		$length = hexdec(substr($hash,128,64));

		$str = substr(hexDecode(substr($hash,192,64)),0,$length);


		$arr = explode(";",$str);
		for ($i=1; $i < count($arr); $i++) { 
			$arr2 = explode(",",$arr[$i]);
			$tmp['date'] = $arr2[0];
        	$tmp['num'] = $arr2[1];
        	$tmp['add_time'] = $arr2['2'];
        	array_push($rdata,$tmp);
		}

		$page += 1;

	}

	return $rdata;
}

function getRecord(){
	global $db;
	global $uid;
	$res = $db->select("records",[
		"work_id",
		"num",
		"date",
		"add_time",
		"hash"
	],[
		"worker_id" => $uid
	]);
	return $res;
}



function hexDecode($s) {			//16->utf-8
    // return preg_replace('/(\w{2})/',"chr(hexdec('\\1'))",$s);
    return preg_replace_callback('/(\w{2})/',
    	function($matches)
    	{	
    		return chr(hexdec($matches[1]));
    	},$s);
}