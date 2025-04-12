<?php

namespace App\Models\Payments;

use App\Core\PaymentValidator;
use App\Enums\PaymentMethods;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payments\CardPayment;
use App\Models\Payments\CashPayment;
use Exception;

class Payment
{
   private const ALLOWED_PAYMENT_METHODS = ["card" => CardPayment::class, "cash" => CashPayment::class];

   public function proccessPayment(Customer $customer, Invoice $invoice, string $paymentMethod)
   {
      $invoiceSum = $invoice->getSum();

      PaymentValidator::validatePaymentProccess($customer, $invoiceSum, $paymentMethod);

      $paymentClass  = self::ALLOWED_PAYMENT_METHODS[$paymentMethod];
      $paymentMethodInstance = new $paymentClass($invoiceSum);

      $paymentMethodInstance->pay($invoiceSum);
   }
}
