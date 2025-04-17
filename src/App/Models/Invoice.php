<?php

namespace App\Models;

use App\Core\Config;
use App\Models\Exporters\HTMLExporter;
use App\Models\Exporters\PDFExporter;

use Exception;
use function App\Core\formatPrice;


class Invoice
{
   private string $paidBy = "";
   private array $items = [];


   public function __construct(
      array  $items,
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

   public function getItems(): array
   {

      return $this->items;
   }


   public function setPaidBy($method)
   {

      return $this->paidBy = $method;
   }

   public function getPaidBy()
   {

      return  strtoupper($this->paidBy);
   }
}
