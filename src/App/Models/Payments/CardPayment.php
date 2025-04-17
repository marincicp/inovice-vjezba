<?php

namespace App\Models\Payments;

use App\Interfaces\PaymentMethodInterface;

final class CardPayment implements PaymentMethodInterface
{


   public function pay(float $amount, float $invoiceSum): bool
   {
      return $amount >= $invoiceSum;
   }
}
