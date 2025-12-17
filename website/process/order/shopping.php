<?php

// if logged in, get cart items from database
if(isset($_SESSION[SESSION_KEY]) && $_SESSION[SESSION_KEY]['auth'] == 1){
    $request = [
        'customerId' => base64_decode($_SESSION[SESSION_KEY]['id'])
    ];
    $items = json_decode(callAPI('GET', '/cart/v1/view', $request, $headers),1);
} else {
    $items = $_SESSION['cart'];
}

// echo "<pre>"; print_r($items); exit;
$data['totals'] = [
    'subtotal' => 0,
    'totalDiscount' => 0,
    'totalTax' => 0,
    'grandTotal' => 0,
];

foreach ($items as $item) {
    $itemQuantity = $item['qty'];
    $itemPrice = $item['price'];
    $itemDiscount = $item['discount']; // Assuming this is a fixed discount amount per item
    $itemTaxRate = $item['tax'];      // Assuming this is a decimal tax rate (e.g., 0.00 for 0%, 0.15 for 15%)

    // Calculate subtotal for the current item (before discount and tax)
    $itemSubtotal = $itemQuantity * $itemPrice;
    $data['totals']['subtotal'] += $itemSubtotal;

    // Calculate discount for the current item
    $itemTotalDiscount = $itemQuantity * $itemDiscount;
    $data['totals']['totalDiscount'] += $itemTotalDiscount;

    // Calculate amount after discount for tax calculation
    $priceAfterDiscount = $itemSubtotal - $itemTotalDiscount;

    // Calculate tax for the current item
    $itemTotalTax = $priceAfterDiscount * $itemTaxRate;
    $data['totals']['totalTax'] += $itemTotalTax;

    // Calculate total for the current item (price - discount + tax)
    $itemGrandTotal = $priceAfterDiscount + $itemTotalTax;
    $data['totals']['grandTotal'] += $itemGrandTotal;
}

$data['totals']['shipping'] = 150;

$data['totals']['grandTotal'] += $data['totals']['shipping'];

foreach ($data['totals'] as $key => $value) {
    $data['totals'][$key] = number_format(ceil($value), 2);
}

if(ReqAjax() && isset($_GET['cart']) && $_GET['cart'] == 'summary'){
    exit(print_j($data));
}

$request = [
    'page' => 0,
    'limit' => 100
];

$data['categories'] = json_decode(callAPI('GET', '/category/v1/view', $request, $headers),1);
$data['items'] = $items;

// echo "<pe>"; print_r($data['totals']); exit;

require BASE_DIR.'layout/cart/shopping-cart.php';