<?php

namespace App\Models\Payments;

use App\Models\Payments\PaymentMethod;

final class CashPayment extends PaymentMethod
{

   public function __construct(float $invoiceSum)
   {
      $this->invoiceSum = $invoiceSum;
   }
}
