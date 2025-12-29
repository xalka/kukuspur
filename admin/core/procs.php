<?php

function Payment($data = null){
	$action = $data['action'];
    $paymentId = formatValue($data['paymentId'] ?? null);
    $planId = formatValue($data['planId'] ?? null);
    $subId = formatValue($data['subId'] ?? null);
    $customerId = formatValue($data['customerId'] ?? null);
    $userId = formatValue($data['userId'] ?? null);
    $phone = formatValue($data['phone'] ?? 0);
    $amount = formatValue($data['amount'] ?? 0);
    $fname = formatValue($data['fname'] ?? null, true);
    $mname = formatValue($data['mname'] ?? null, true);
    $lname = formatValue($data['lname'] ?? null, true);
    $pass = formatValue($data['pass'] ?? '', true);
    $reference = formatValue($data['reference'] ?? '', true);
    $MerchantRequestID = formatValue($data['MerchantRequestID'] ?? '', true);
    $CheckoutRequestID = formatValue($data['CheckoutRequestID'] ?? '', true);

    $modeId = formatValue($data['modeId'] ?? null);
    $statusId = formatValue($data['statusId'] ?? null);
    $posted = formatValue($data['posted'] ?? 0);
    $description = formatValue($data['description'] ?? '', true);
	
    $thirdpartyTime = isset($data['thirdpartyTime']) && !empty($data['thirdpartyTime']) ? "'" . datetime($data['thirdpartyTime']) . "'" : 'NULL';
    $starttime = isset($data['starttime']) && !empty($data['starttime']) ? "'" . datetime($data['starttime']) . "'" : 'NULL';
    $endtime = isset($data['endtime']) && !empty($data['endtime']) ? "'" . datetime($data['endtime']) . "'" : 'NULL';

    $start = (int) ($data['start'] ?? START);
    $limit = (int) ($data['limit'] ?? LIMIT);

    return "PAYMENT($action, $paymentId, $planId, $subId, $customerId, $userId, $phone, $amount, $fname, $mname, $lname, $pass, $reference, $MerchantRequestID, $CheckoutRequestID, $modeId, $statusId, $posted, $description, $thirdpartyTime, $starttime, $endtime, $start, $limit)";
}

function Customer($data=null){
	$action = $data['action'];
	$customerId = isset($data['customerId'])  && !empty($data['customerId']) ? $data['customerId'] : 'null';
	$email = isset($data['email'])  && !empty($data['email']) ? $data['email'] : '0';
	$phone = isset($data['phone'])  && !empty($data['phone']) ? $data['phone'] : '0';
	$fname = isset($data['fname'])  && !empty($data['fname']) ? $data['fname'] : '0';
	$lname = isset($data['lname'])  && !empty($data['lname']) ? $data['lname'] : '0';
	$active = isset($data['active'])  && !empty($data['active']) ? $data['active'] : 'null';
	$passreset = isset($data['passreset'])  && !empty($data['passreset']) ? $data['passreset'] : 'null';
	$pass = isset($data['pass'])  && !empty($data['pass']) ? $data['pass'] : 'null';
	$code = isset($data['code'])  && !empty($data['code']) ? $data['code'] : 'null';
	$userId = isset($data['userId'])  && !empty($data['userId']) ? $data['userId'] : 'null';
	$starttime = isset($data['starttime'])  && !empty($data['starttime']) ? $data['starttime'] : date('Y-m-d');
	$endtime = isset($data['endtime'])  && !empty($data['endtime']) ? $data['endtime'] : date('Y-m-d');
	$start = isset($data['start'])  && !empty($data['start']) ? $data['start'] : START;
	$limit = isset($data['limit'])  && !empty($data['limit']) ? $data['limit'] : LIMIT;

	return "CUSTOMER($action,$customerId,'$email','$phone','$fname','$lname',$active,$passreset,'$pass',$code,$userId,'$starttime','$endtime',$start,$limit)";
}

function Product($data=null){
	$action = $data['action'];
	$productId = isset($data['productId']) && !empty($data['productId']) ? $data['productId'] : 'null';
	$userId = isset($data['userId'])  && !empty($data['userId']) ? $data['userId'] : 'null';
	$customerId = isset($data['customerId'])  && !empty($data['customerId']) ? $data['customerId'] : 'null';
	$categoryId = isset($data['categoryId'])  && !empty($data['categoryId']) ? $data['categoryId'] : 'null';
	$title = isset($data['title'])  && !empty($data['title']) ? $data['title'] : 'null';
	$subtitle = isset($data['subtitle'])  && !empty($data['subtitle']) ? $data['subtitle'] : 'null';
	$content = isset($data['content'])  && !empty($data['content']) ? $data['content'] : 'null';
	$tags = isset($data['tags'])  && !empty($data['tags']) ? $data['tags'] : 'null';
	$image = isset($data['image'])  && !empty($data['image']) ? $data['image'] : 'null';
	$statusId = isset($data['statusId'])  && !empty($data['statusId']) ? $data['statusId'] : 'null';
	$topproduct = isset($data['topproduct']) && ($data['topproduct'] !== '') ? $data['topproduct'] : 'null';
	$publishedAt = isset($data['publishedAt'])  && !empty($data['publishedAt']) ? $data['publishedAt'] : date(NOW,strtotime('Y-m-d'));
	$starttime = isset($data['starttime'])  && !empty($data['starttime']) ? $data['starttime'] : date(NOW,strtotime('Y-m-d'));
	$endtime = isset($data['endtime'])  && !empty($data['endtime']) ? $data['endtime'] : date(NOW,strtotime('Y-m-d'));
	$start = isset($data['start'])  && !empty($data['start']) ? $data['start'] : START;
	$limit = isset($data['limit'])  && !empty($data['limit']) ? $data['limit'] : LIMIT;

	return "PRODUCT($action,$productId,$userId,$customerId,$categoryId,'$title','$subtitle','$content','$tags','$image',$statusId,$topproduct,'$publishedAt','$starttime','$endtime',$start,$limit)";
}

function User($data=null){ 
	$action = $data['action'];
	$userId = isset($data['userId']) && !empty($data['userId']) ? $data['userId'] : 'null';
	$email = isset($data['email']) && !empty($data['email']) ? $data['email'] : '0';
	$phone = isset($data['phone']) && !empty($data['phone']) ? $data['phone'] : '0';
	$fname = isset($data['fname']) && !empty($data['fname']) ? $data['fname'] : '0';
	$lname = isset($data['lname']) && !empty($data['lname']) ? $data['lname'] : '0';
	$active = isset($data['active']) && !empty($data['active']) ? $data['active'] : 'null';
	$passreset = isset($data['passreset']) && !empty($data['passreset']) ? $data['passreset'] : 'null';
	$pass = isset($data['pass']) && !empty($data['pass']) ? $data['pass'] : 'null';
	$code = isset($data['code']) && !empty($data['code']) ? $data['code'] : 'null';
	$typeId = isset($data['typeId']) && !empty($data['typeId']) ? $data['typeId'] : 'null';
	$roleId = isset($data['roleId']) && !empty($data['roleId']) ? $data['roleId'] : 'null';
	$adminId = isset($data['adminId']) && !empty($data['adminId']) ? $data['adminId'] : 'null';
	$passExpire = isset($data['expiretime']) && !empty($data['expiretime']) ? $data['expiretime'] : date('Y-m-d');
	$starttime = isset($data['starttime']) && !empty($data['starttime']) ? $data['starttime'] : date('Y-m-d');
	$endtime = isset($data['endtime']) && !empty($data['endtime']) ? $data['endtime'] : date('Y-m-d');
	$start = isset($data['start']) && !empty($data['start']) ? $data['start'] : START;
	$limit = isset($data['limit']) && !empty($data['limit']) ? $data['limit'] : LIMIT;

	return "USERS($action,$userId,'$email','$phone','$fname','$lname',$active,$passreset,'$pass',$code,$typeId,$roleId,$adminId,'$passExpire','$starttime','$endtime',$start,$limit)";
}