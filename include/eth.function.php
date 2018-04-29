<?php
function to64Hex($data){
	$res = dechex($data);
	$num0 = 64-strlen($res);
	$res0 = "";
	for ($i=0; $i < $num0; $i++)
		$res0 = $res0."0";
	$res = $res0.$res;
	return $res;
}

function addRecord($id,$num,$date){
	date_default_timezone_set('PRC');
	$data = "0xc1168ab6".to64Hex($id).to64Hex($num).to64Hex($date).to64Hex(time());

	$params = array();
	$address_form = "0x937f691d50adbb02f2fe801395e79f63d95ac4a2";
	$address_to = "0x1083daa2481144114ec53ae767038ca749c18394";
	$params[0] = array("from" => $address_form,"to" => $address_to,"data" => $data);

	$post_data = array("jsonrpc" => "2.0", "method" => "eth_sendTransaction", "id"=>1, "params"=>$params);
	$post_data = json_encode($post_data);

	$curl = curl_init('http://localhost');
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

	return $res;
}

function calHour($id){
	$data = "0xc64f634d".to64Hex($id);

	$params = array();
	$address_to = "0x1083daa2481144114ec53ae767038ca749c18394";
	$params[0] = array("to" => $address_to,"data" => $data);
	$params[1] = "latest";

	$post_data = array("jsonrpc" => "2.0", "method" => "eth_call", "id"=>2, "params"=>$params);
	$post_data = json_encode($post_data);

	$curl = curl_init('http://localhost');
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
	return str_replace("\\", "11", $res);
}