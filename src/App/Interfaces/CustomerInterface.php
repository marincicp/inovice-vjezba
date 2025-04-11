<?php

namespace App\Interfaces;

interface CustomerInterface
{
   public function setName(string $name): string;
   public function setCard(int $cardNumber): int;
   public function setSaldo(float $amount, bool $decrease): float;

   public function getCard(): int|null;
   public function getSaldo(): float;
   public function getName(): string;
}
