<?php


namespace App\Interfaces;


interface PaymentMethodInterface
{
   public function pay(float $amount): bool;
}
