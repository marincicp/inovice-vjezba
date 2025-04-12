<?php

namespace App\Core;

use App\Enums\PaymentMethods;
use Exception;

class PaymentValidator extends Validator
{


   private const ALLOWED_PAYMENT_METHODS = ["card", "cash"];


   public static function validateCard(int $cardNumber)
   {
      return is_int($cardNumber) && strlen($cardNumber) === 16;
   }


   public static function validateUserCard(?int $card)
   {
      if (! $card || ! self::validateCard($card)) {
         return false;
      }

      return true;
   }

   public static function validateUserSaldo(float $saldo, float $invoiceSum)
   {

      if ($saldo < $invoiceSum) {
         return false;
      }
      return true;
   }


   public static function validatePaymentMethod($paymentMethod)
   {
      if (! in_array($paymentMethod, self::ALLOWED_PAYMENT_METHODS)) {
         return false;
      }
      return true;
   }





   public static  function validatePaymentProccess($customer, $invoiceSum, $paymentMethod)
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
