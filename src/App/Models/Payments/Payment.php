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

   public function makePayment(Customer $customer, Invoice $invoice, string $paymentMethod)
   {
      $invoiceSum = $invoice->getSum();

      $this->validatePayment($customer, $invoiceSum, $paymentMethod);


      $paymentClass  = self::ALLOWED_PAYMENT_METHODS[$paymentMethod];
      $paymentMethodInstance = new $paymentClass($invoiceSum);

      $paymentMethodInstance->pay($invoiceSum);
   }




   public  function validatePayment($customer, $invoiceSum, $paymentMethod)
   {
      if (! PaymentValidator::validatePaymentMethod($paymentMethod)) {
         throw new Exception("$paymentMethod is invalid payment method.");
      }
      if (! PaymentValidator::validateUserSaldo($customer->getSaldo(), $invoiceSum)) {
         throw new Exception("You don't have enough money.");
      }

      if ($paymentMethod === PaymentMethods::card) {
         if (! PaymentValidator::validateUserCard($customer->getCard())) {
            throw new Exception("Please add your card first");
         }
      }
      return true;
   }
}
