<?php

namespace App\Models\Payments;

use App\Models\Payments\PaymentMethod;

final class CardPayment extends PaymentMethod
{

   public function __construct(float $invoiceSum)
   {
      $this->invoiceSum = $invoiceSum;
   }
}
