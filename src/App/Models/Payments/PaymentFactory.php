<?php

namespace App\Models\Payments;

use App\Interfaces\PaymentMethodInterface;
use Exception;

class PaymentFactory
{

   public static function create(string $paymentMethod): PaymentMethodInterface| string
   {
      return match ($paymentMethod) {
         "card" => new CardPayment,
         "cash" => new  CashPayment,

         "default" => throw new Exception("Unknown payment method")
      };
   }
}
