<?php

namespace App\Models;

use App\Core\PaymentValidator;
use App\Core\Validator;
use App\Interfaces\CustomerInterface;
use Exception;

class Customer implements CustomerInterface
{
   private string $name = "";
   private float $saldo = 0.00;
   private ?int $cardNumber;



   public function __construct(string $name, float $saldo, ?int $cardNumber = null)
   {

      $this->setName($name);
      $this->setSaldo($saldo);

      if ($cardNumber) {
         $this->setCard($cardNumber);
      }
   }


   public function setName($name): string
   {
      if (! Validator::string($name, 3)) {
         throw new  Exception("Invalid name");
      }

      return  $this->name = $name;
   }


   public function setSaldo(float $amount, bool $decrease = false): float
   {
      if (! Validator::isFloat($amount)) {
         throw new  Exception("Invalid amount");
      }

      if ($decrease) {
         $this->saldo -=  $amount;
      } else {
         $this->saldo += $amount;
      }

      return  round($this->saldo, 2);
   }

   public function setCard(int $cardNumber): int
   {

      if (! PaymentValidator::validateCard($cardNumber)) {
         throw new Exception("Invalid card number");
      }
      return $this->cardNumber  = $cardNumber;
   }



   public function getCard(): int|null
   {
      return $this->cardNumber;
   }


   public function getSaldo(): float
   {
      return $this->saldo;
   }

   public function getName(): string
   {
      return $this->name;
   }
}
