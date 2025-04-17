<?php

namespace App\Models\Payments;

use App\Core\Config;
use App\Core\PaymentValidator;
use App\Enums\PaymentMethods;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payments\CardPayment;
use App\Models\Payments\CashPayment;
use Exception;

class Payment
{

   private array $ALLOWED_PAYMENT_METHODS = [];

   public function __construct()
   {
      $this->ALLOWED_PAYMENT_METHODS = Config::$ALLOWED_PAYMENT_METHODS;
   }

   public function proccessPayment(Customer $customer, Invoice $invoice, string $paymentMethod)
   {
      $invoiceSum = $invoice->getSum();

      PaymentValidator::validatePaymentProccess($customer, $invoiceSum, $paymentMethod);

      $invoice->setPaidBy($paymentMethod);

      PaymentFactory::create($paymentMethod)->pay($customer->getSaldo(), $invoiceSum);
   }
}
