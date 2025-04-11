<?php

namespace App\Models;

use function App\Core\formatPrice;

require_once "src/App/Core/helpers.php";

class Invoice
{
   private array $items = [];

   public function __construct(
      $items
   ) {
      $this->items = $items;
   }


   public function getSum(): float
   {
      $sum = 0;
      foreach ($this->items as $item) {
         $sum += $item["price"] * 100;
      }

      return formatPrice($sum);
   }
}
