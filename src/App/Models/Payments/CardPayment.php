<?php

namespace App\Models\Payments;

use App\Interfaces\PaymentMethodInterface;

class CardPayment extends Payment
{

   public function __construct(float $invoiceSum)
   {
      $this->invoiceSum = $invoiceSum;
   }
}
