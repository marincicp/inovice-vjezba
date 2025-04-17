<?php

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Store;

use function App\Core\dd;

require __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/App/Core/helpers.php";

$cart = [
   [
      "name" => "jabuke",
      "price" => 2.99,
   ],
   [
      "name" => "kruske",
      "price" => 3.99,
   ]
];


$store  = Store::getInstance();

$invoice = new Invoice($cart);


// CUSTOMER
$testCardNumber =  1111222233334444;
$customer = new Customer("Pero Peric", 22.30, null, $testCardNumber);

////////////////////////////
// CUSTOMER - REGISTER ONLINE
$onlineCustomer1 = $store->registerCustomerOnline("Ana Anic", 20, "ana@test.com");

$onlineCustomer2 = $store->registerCustomerOnline("Ivan Ivic", 20, "ivan@test.com");

$onlineCustomer3 = $store->registerCustomerOnline("Ante Anic", 20, "ante@test.com");


// SEND EMAIL NOTIFICATION
$store->couponEmailNotification->notify(["content" => "Get 20% off with coupon code: FGDFGAS", "subject" => "New coupon"]);

// $store->couponEmailNotification->detachAll();


$isPaymentSuccess = $store->makePayment($customer, $invoice, "card", "html");

if ($isPaymentSuccess) {
   $customer->setSaldo($invoice->getSum(), true);
}

dd($customer);
