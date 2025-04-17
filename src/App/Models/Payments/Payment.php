<?php

namespace App\Models\Payments;

use App\Core\PaymentValidator;
use App\Models\Customer;
use App\Models\Invoice;
use ErrorException;

class Payment
{


   public function proccessPayment(Customer $customer, Invoice $invoice, string $paymentMethod)
   {
      $invoiceSum = $invoice->getSum();

      PaymentValidator::validatePaymentProccess($customer, $invoiceSum, $paymentMethod);

      $isPaymentSuccess =  PaymentFactory::create($paymentMethod)->pay($customer->getSaldo(), $invoiceSum);

      if (! $isPaymentSuccess) {
         throw new ErrorException("Failed to pay invoice");
      }

      $invoice->setPaidBy($paymentMethod);
   }
}
