<?php

namespace App\Models;

use App\Core\Config;
use App\Interfaces\SubjectInterface;
use App\Notifications\CouponEmailNotification;
use Exception;

class Store
{

   private static ?Store $instance  = null;
   private string $name = "";
   private string $location = "";
   private int $totalSold = 0;

   public SubjectInterface $couponEmailNotification;
   private function __construct()
   {
      $this->name = Config::$storeName;
      $this->location = Config::$storeLocation;
      $this->couponEmailNotification  = new CouponEmailNotification();
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

   public function registerCustomerOnline(string $name, float $saldo, string $email): Customer
   {
      $testCardNumber =  1111222233334444;

      if (! $email) {
         throw new Exception("You must provide email");
      }

      $customer =  new Customer($name, $saldo, $email, $testCardNumber);

      $this->couponEmailNotification->attach($customer);

      return $customer;
   }
}
