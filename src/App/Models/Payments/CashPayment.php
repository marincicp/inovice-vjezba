<?php

namespace App\Models\Payments;

use App\Interfaces\PaymentMethodInterface;
use App\Models\Payments\PaymentMethod;

final class CashPayment implements PaymentMethodInterface
{
   public function pay(float $amount, float $invoiceSum): bool
   {
      return $amount >= $invoiceSum;
   }
}
