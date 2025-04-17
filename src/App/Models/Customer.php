<?php

namespace App\Models;

use App\Core\PaymentValidator;
use App\Core\Validator;
use App\Interfaces\CustomerInterface;
use App\Interfaces\ObserverInterface;
use Exception;

class Customer implements CustomerInterface, ObserverInterface
{
   private string $name = "";
   private float $saldo = 0.00;
   private ?int $cardNumber;
   private ?string $email;




   public function __construct(string $name, float $saldo, ?string $email = null,  ?int $cardNumber = null)
   {

      $this->setName($name);
      $this->setSaldo($saldo);

      if ($cardNumber) {
         $this->setCard($cardNumber);
      }
      if ($email) {
         $this->setEmail($email);
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
   public function setEmail(string $email): string
   {

      if (! Validator::email($email)) {
         throw new Exception("Invalid email");
      }

      return $this->email  = $email;
   }


   public function getCard(): int|null
   {
      return $this->cardNumber;
   }
   public function getEmail(): string|null
   {
      return $this->email;
   }


   public function getSaldo(): float
   {
      return $this->saldo;
   }

   public function getName(): string
   {
      return $this->name;
   }

   public function update($eventData): void
   {
      new SendMail($this, $eventData);
   }
}
