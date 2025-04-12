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

$invoice = new Invoice($cart, "html");


// CUSTOMER
$testCardNumber =  1111222233334444;
$customer = new Customer("Pero Peric", 22.30, $testCardNumber);


$store  = Store::getInstance();

$isPaymentSuccess = $store->makePayment($customer, $invoice, "card");

if ($isPaymentSuccess) {
   $customer->setSaldo($invoice->getSum(), true);
}

dd($customer);
