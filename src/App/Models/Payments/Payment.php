<?php

namespace App\Models\Payments;

use App\Interfaces\PaymentMethodInterface;

abstract class Payment implements PaymentMethodInterface
{

   protected float $invoiceSum;


   public function pay(float $amount): bool
   {
      return $amount >= $this->invoiceSum;
   }
}
