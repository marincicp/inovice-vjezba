<?php

namespace App\Models;

use App\Core\Config;
use App\Models\Payments\Payment;
use Exception;

class Store
{

   private static ?Store $instance  = null;
   private string $name = "";
   private string $location = "";
   private int $totalSold = 0;


   private function __construct()
   {
      $this->name = Config::$storeName;
      $this->location = Config::$storeLocation;
   }

   private function __clone() {}


   public static function getInstance(): Store|null
   {
      if (self::$instance === null) {
         self::$instance = new Store();
      }

      return self::$instance;
   }


   public function  makePayment(Customer $customer, Invoice $invoice, string $paymentMethod, $exportType)
   {
      try {
         new InvoiceGenerator($customer, $invoice, $paymentMethod, $exportType);

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

   public function getName(): string
   {
      return $this->name;
   }
   public function getLocation(): string
   {
      return $this->location;
   }
}
