<?php

namespace App\Models;

use App\Models\Payments\Payment;
use Exception;

class Store
{

   private static ?Store $instance  = null;
   private string $name = "Super Store";
   private string $location = "Zagreb";
   private ?Payment $payment;
   private int $totalSold = 0;


   private function __construct()
   {
      $this->payment = new Payment();
   }

   private function __clone() {}


   public static function getInstance(): Store|null
   {
      if (self::$instance === null) {
         self::$instance = new Store();
      }

      return self::$instance;
   }


   public function  proccessPayment(Customer $customer, Invoice $invoice, string $paymentMethod)
   {
      try {
         $this->payment->makePayment($customer, $invoice, $paymentMethod);


         new InvoiceGenerator($invoice);
         $this->totalSold++;

         return true;
      } catch (Exception $err) {
         echo $err->getMessage();
      }
   }


   public function getTotalSold(): int
   {
      return $this->totalSold;
   }
}
