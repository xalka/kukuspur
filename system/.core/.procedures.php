<?php

function Order($data=null){
	$action = $data['action'];
	$cartId = isset($data['cartId']) && !empty($data['cartId']) ? $data['cartId'] : 'null';
	$orderId = isset($data['orderId'])  && !empty($data['orderId']) ? $data['orderId'] : 'null';
	$productId = isset($data['productId'])  && !empty($data['productId']) ? $data['productId'] : 'null';
	$qty = isset($data['qty'])  && !empty($data['qty']) ? $data['qty'] : 'null';
	$customerId = isset($data['customerId'])  && !empty($data['customerId']) ? $data['customerId'] : 'null';
	$adminId = isset($data['adminId'])  && !empty($data['adminId']) ? $data['adminId'] : 'null';
	$addressId = isset($data['addressId'])  && !empty($data['addressId']) ? $data['addressId'] : 'null';
	$active = isset($data['active'])  && !empty($data['active']) ? $data['active'] : 'null';
	$price = isset($data['price'])  && !empty($data['price']) ? $data['price'] : 'null';
	$discount = isset($data['discount'])  && !empty($data['discount']) ? $data['discount'] : 0;
	$tax = isset($data['tax'])  && !empty($data['tax']) ? $data['tax'] : 0;
	$shipping = isset($data['shipping'])  && !empty($data['shipping']) ? $data['shipping'] : 0;
	$paymentModeId = isset($data['modeId'])  && !empty($data['modeId']) ? $data['modeId'] : 0;
	$paymentId = isset($data['paymentId'])  && !empty($data['paymentId']) ? $data['paymentId'] : 0;
	$starttime = isset($data['starttime'])  && !empty($data['starttime']) ? $data['starttime'] : date(NOW,strtotime('Y-m-d'));
	$endtime = isset($data['endtime'])  && !empty($data['endtime']) ? $data['endtime'] : date(NOW,strtotime('Y-m-d'));
	$start = isset($data['start'])  && !empty($data['start']) ? $data['start'] : START;
	$limit = isset($data['limit'])  && !empty($data['limit']) ? $data['limit'] : LIMIT;

	return "EORDER($action,$cartId,$orderId,$productId,$qty,$customerId,$adminId,$addressId,$active,$price,$discount,$tax,$shipping,$paymentModeId,$paymentId,'$starttime','$endtime',$start,$limit);";
}

function ProductI($data=null){
	$action = $data['action'];
	$productId = isset($data['productId']) && !empty($data['productId']) ? $data['productId'] : 'null';
	$product = isset($data['product'])  && !empty($data['product']) ? $data['product'] : '0';
	$desc = isset($data['desc'])  && !empty($data['desc']) ? $data['desc'] : '0';
	$seo = isset($data['seo'])  && !empty($data['seo']) ? $data['seo'] : '0';
	$meta = isset($data['meta'])  && !empty($data['meta']) ? $data['meta'] : '0';
	$categoryId = isset($data['categoryId'])  && !empty($data['categoryId']) ? $data['categoryId'] : 'null';
	$viewId = isset($data['viewId'])  && !empty($data['viewId']) ? $data['viewId'] : 'null';
	$sku = isset($data['sku'])  && !empty($data['sku']) ? $data['sku'] : '0';
	$customerId = isset($data['customerId'])  && !empty($data['customerId']) ? $data['customerId'] : 'null';
	$adminId = isset($data['adminId'])  && !empty($data['adminId']) ? $data['adminId'] : 'null';
	$active = isset($data['active'])  && !empty($data['active']) ? $data['active'] : '0';
	$price = isset($data['price'])  && !empty($data['price']) ? $data['price'] : 'null';
	$discount = isset($data['discount'])  && !empty($data['discount']) ? $data['discount'] : 'null';
	$tax = isset($data['tax'])  && !empty($data['tax']) ? $data['tax'] : 'null';
	$ostock = isset($data['ostock'])  && !empty($data['ostock']) ? $data['ostock'] : 'null';
	$cstock = isset($data['cstock'])  && !empty($data['cstock']) ? $data['cstock'] : 'null';
	$price = isset($data['price'])  && !empty($data['price']) ? $data['price'] : 'null';
	$typeId = isset($data['typeId'])  && !empty($data['typeId']) ? $data['typeId'] : 'null';
	$starttime = isset($data['starttime'])  && !empty($data['starttime']) ? $data['starttime'] : date(NOW,strtotime('Y-m-d'));
	$endtime = isset($data['endtime'])  && !empty($data['endtime']) ? $data['endtime'] : date(NOW,strtotime('Y-m-d'));
	$start = isset($data['start'])  && !empty($data['start']) ? $data['start'] : START;
	$limit = isset($data['limit'])  && !empty($data['limit']) ? $data['limit'] : LIMIT;

	return "PRODUCT($action,$productId,'$product','$desc','$sku',$categoryId,$price,$active,$typeId,$adminId,$customerId,'$starttime','$endtime',$start,$limit)";
}

function Product($data = null) {
    // Helper to extract values safely
    // function getVal($data, $key, $default = 'null', $wrap = false) {
    //     if (isset($data[$key]) && $data[$key] !== '') {
    //         return $wrap ? "'" . addslashes($data[$key]) . "'" : $data[$key];
    //     }
    //     return $default;
    // }

    function getVal($data, $key, $default = 'null', $wrap = false) {
        if (isset($data[$key]) && $data[$key] !== '') {
            return $wrap ? "'" . addslashes($data[$key]) . "'" : $data[$key];
        }
        return $default;
    }	

    $action      = getVal($data, 'action', 'null', false);
    $productId   = getVal($data, 'productId');
    $product     = getVal($data, 'product', '0', true);
    $descrp		 = getVal($data, 'descrp', '0', true);
    $seo         = getVal($data, 'seo_title', '0', true);
    $meta        = getVal($data, 'meta_descrp', '0', true);
    $categoryId  = getVal($data, 'categoryId');
    $viewId      = getVal($data, 'viewId', 1);
    $sku         = getVal($data, 'sku', '0', true);
    $imgs        = getVal($data, 'imgs', '0', false);
    $customerId  = getVal($data, 'customerId');
    $adminId     = getVal($data, 'adminId');
    $active      = getVal($data, 'statusId', '0');
    $price       = getVal($data, 'price',0);
    $discount    = getVal($data, 'discount',0);
    $tax         = getVal($data, 'tax',0);
    $ostock      = getVal($data, 'ostock');
    $cstock      = getVal($data, 'cstock');
    $typeId      = getVal($data, 'typeId');

    $latitude	 = getVal($data, 'latitude');
    $longitude	 = getVal($data, 'longitude');	

    $nowDate     = date('Y-m-d');
    $starttime   = getVal($data, 'starttime', "'$nowDate'", true);
    $endtime     = getVal($data, 'endtime', "'$nowDate'", true);

    $start       = getVal($data, 'start', START);
    $limit       = getVal($data, 'limit', LIMIT);

    return "PRODUCT($action, $productId, $product, $descrp, $seo, $meta, $categoryId, $viewId, $sku, '$imgs', $customerId, $adminId, $active, $price, $discount, $tax, $ostock, $cstock, $typeId, $latitude, $longitude, $starttime, $endtime, $start, $limit)";

}

function ProductII($data = null) {
    // Helper to extract values safely
    function getVal($data, $key, $default = 'null', $wrap = false) {
        if (isset($data[$key]) && $data[$key] !== '') {
            return $wrap ? "'" . addslashes($data[$key]) . "'" : $data[$key];
        }
        return $default;
    }

    $action      = getVal($data, 'action', 'null', false);
    $productId   = getVal($data, 'productId');
    $product     = getVal($data, 'product', '0', true);
    $descrp      = getVal($data, 'descrp', '0', true);
    $seo         = getVal($data, 'seo_title', '0', true);
    $meta        = getVal($data, 'meta_descrp', '0', true);
    $categoryId  = getVal($data, 'categoryId');
    $viewId      = getVal($data, 'viewId', 1);
    $sku         = getVal($data, 'sku', '0', true);
    // No special wrapping for imgs here, as it should already be a JSON string
    $imgs        = getVal($data, 'imgs', '0', false);
    $customerId  = getVal($data, 'customerId');
    $adminId     = getVal($data, 'adminId');
    $active      = getVal($data, 'statusId', '0');
    $price       = getVal($data, 'price',0);
    $discount    = getVal($data, 'discount',0);
    $tax         = getVal($data, 'tax',0);
    $ostock      = getVal($data, 'ostock');
    $cstock      = getVal($data, 'cstock');
    $typeId      = getVal($data, 'typeId');

    $latitude	 = getVal($data, 'latitude');
    $longitude	 = getVal($data, 'longitude');	

    $nowDate     = date('Y-m-d');
    $starttime   = getVal($data, 'starttime', "'$nowDate'", true);
    $endtime     = getVal($data, 'endtime', "'$nowDate'", true);

    $start       = getVal($data, 'start', START);
    $limit       = getVal($data, 'limit', LIMIT);

    return "PRODUCT($action, $productId, $product, $descrp, $seo, $meta, $categoryId, $viewId, '$imgs', $customerId, $adminId, $active, $price, $discount, $tax, $ostock, $cstock, $typeId, $latitude, $longitude, $starttime, $endtime, $start, $limit)";

}


function Category($data=null){
	$action = $data['action'];
	$categoryId = isset($data['categoryId']) && !empty($data['categoryId']) ? $data['categoryId'] : 'null';
	$category = isset($data['category'])  && !empty($data['category']) ? $data['category'] : '0';
	$parentId = isset($data['parentId']) && !empty($data['parentId']) ? $data['parentId'] : 'null';
	$productId = isset($data['productId']) && !empty($data['productId']) ? $data['productId'] : 'null';
	$adminId = isset($data['adminId']) && !empty($data['adminId']) ? $data['adminId'] : 'null';
	$active = isset($data['active'])  && !empty($data['active']) ? $data['active'] : 'null';
	$starttime = isset($data['starttime'])  && !empty($data['starttime']) ? $data['starttime'] : date(NOW,strtotime('Y-m-d'));
	$endtime = isset($data['endtime'])  && !empty($data['endtime']) ? $data['endtime'] : date(NOW,strtotime('Y-m-d'));
	$start = isset($data['start'])  && !empty($data['start']) ? $data['start'] : START;
	$limit = isset($data['limit'])  && !empty($data['limit']) ? $data['limit'] : LIMIT;

	return "CATEGORY($action,$categoryId,'$category',$parentId,$productId,$adminId,$active,'$starttime','$endtime',$start,$limit)";
}

function Payment($data=null){
	$action = $data['action'];
	$paymentId = isset($data['paymentId']) && !empty($data['paymentId']) ? $data['paymentId'] : 'null';
	$customerId = isset($data['customerId'])  && !empty($data['customerId']) ? $data['customerId'] : 'null';
	$orderId = isset($data['orderId'])  && !empty($data['orderId']) ? $data['orderId'] : 'null';
	$phone = isset($data['phone'])  && !empty($data['phone']) ? $data['phone'] : 0;
	$amount = isset($data['amount'])  && !empty($data['amount']) ? $data['amount'] : 0;
	$fname = isset($data['fname'])  && !empty($data['fname']) ? $data['fname'] : 'null';
	$mname = isset($data['mname'])  && !empty($data['mname']) ? $data['mname'] : 'null';
	$lname = isset($data['lname'])  && !empty($data['lname']) ? $data['lname'] : 'null';
	$reference = isset($data['reference'])  && !empty($data['reference']) ? $data['reference'] : 0;
	$MerchantRequestID = isset($data['MerchantRequestID'])  && !empty($data['MerchantRequestID']) ? $data['MerchantRequestID'] : 0;
	$CheckoutRequestID = isset($data['CheckoutRequestID'])  && !empty($data['CheckoutRequestID']) ? $data['CheckoutRequestID'] : 0;
	$repCode = isset($data['ResponseCode'])  && !empty($data['ResponseCode']) ? $data['ResponseCode'] : 'null';
	$modeId = isset($data['modeId'])  && !empty($data['modeId']) ? $data['modeId'] : 'null';
	$statusId = isset($data['statusId'])  && !empty($data['statusId']) ? $data['statusId'] : 'null';
	$posted = isset($data['posted'])  && !empty($data['posted']) ? $data['posted'] : 0;
	$description = isset($data['description'])  && !empty($data['description']) ? $data['description'] : 0;
	$thirdpartyTime = isset($data['thirdpartyTime'])  && !empty($data['thirdpartyTime']) ? $data['thirdpartyTime'] : date(NOW,strtotime('Y-m-d'));
	$starttime = isset($data['starttime'])  && !empty($data['starttime']) ? $data['starttime'] : date(NOW,strtotime('Y-m-d'));
	$endtime = isset($data['endtime'])  && !empty($data['endtime']) ? $data['endtime'] : date(NOW,strtotime('Y-m-d'));
	$start = isset($data['start'])  && !empty($data['start']) ? $data['start'] : START;
	$limit = isset($data['limit'])  && !empty($data['limit']) ? $data['limit'] : LIMIT;

	return "PAYMENT($action,$paymentId,$customerId,$orderId,$phone,$amount,'$fname','$mname','$lname','$reference','$MerchantRequestID','$CheckoutRequestID',$repCode,$modeId,$statusId,$posted,'$description','$thirdpartyTime','$starttime','$endtime',$start,$limit)";
}

function Customer($data=null){
	$action = $data['action'];
	$customerId = isset($data['customerId'])  && !empty($data['customerId']) ? $data['customerId'] : 'null';
	$email = isset($data['email'])  && !empty($data['email']) ? $data['email'] : '0';
	$phone = isset($data['phone'])  && !empty($data['phone']) ? $data['phone'] : '0';
	$fname = isset($data['fname'])  && !empty($data['fname']) ? $data['fname'] : '0';
	$lname = isset($data['lname'])  && !empty($data['lname']) ? $data['lname'] : '0';
	$active = isset($data['active'])  && !empty($data['active']) ? $data['active'] : 'null'; // default
	$verified = isset($data['verified'])  && !empty($data['verified']) ? $data['verified'] : 'null'; 
	$passreset = isset($data['passreset'])  && !empty($data['passreset']) ? $data['passreset'] : 'null';
	$pass = isset($data['password'])  && !empty($data['password']) ? $data['password'] : 'null';
	$code = isset($data['code'])  && !empty($data['code']) ? $data['code'] : 'null';
	$typeId = isset($data['typeId'])  && !empty($data['typeId']) ? $data['typeId'] : 'null';
	$adminId = isset($data['adminId'])  && !empty($data['adminId']) ? $data['adminId'] : 'null';
	$locale = isset($data['locale'])  && !empty($data['locale']) ? $data['locale'] : 'null';
	$latitude = isset($data['latitude'])  && !empty($data['latitude']) ? $data['latitude'] : 'null';
	$longitude = isset($data['longitude'])  && !empty($data['longitude']) ? $data['longitude'] : 'null';
	$passExpire = isset($data['expiretime'])  && !empty($data['expiretime']) ? $data['expiretime'] : date('Y-m-d');
	$starttime = isset($data['starttime'])  && !empty($data['starttime']) ? $data['starttime'] : date('Y-m-d');
	$endtime = isset($data['endtime'])  && !empty($data['endtime']) ? $data['endtime'] : date('Y-m-d');
	$start = isset($data['start'])  && !empty($data['start']) ? $data['start'] : START;
	$limit = isset($data['limit'])  && !empty($data['limit']) ? $data['limit'] : LIMIT;

	return "CUSTOMER($action,$customerId,'$email','$phone','$fname','$lname',$active,$verified,$passreset,'$pass','$code',$typeId,$adminId,'$locale',$latitude,$longitude,'$passExpire','$starttime','$endtime',$start,$limit)";
}