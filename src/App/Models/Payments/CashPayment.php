<?php

namespace App\Models\Payments;


class CashPayment extends Payment
{

   public function __construct(float $invoiceSum)
   {
      $this->invoiceSum = $invoiceSum;
   }
}
