<?php

use App\Models\Exporters\PDFExporter;
use App\Models\Invoice;
use App\Models\InvoiceGenerator;
use App\Models\Payments\CardPayment;
use App\Models\Payments\CashPayment;

require __DIR__ . "/vendor/autoload.php";


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

$invoice = new Invoice($cart);

$invoiceSum = $invoice->getSum();

// $payInvoice = new CashPayment($invoiceSum);
$payInvoice = new CardPayment($invoiceSum);




if ($payInvoice->pay(22.2)) {
   $invoiceGenerator = new InvoiceGenerator($invoice, new PDFExporter);
} else {
   echo  "Neuspješno plaćanje.";
}
