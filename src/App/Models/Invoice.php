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
   public string $exportType = "";
   private array  $ALLOWED_EXPORT_INVOICE_TYPES = [];


   public function __construct(
      array  $items,
      string $exportType
   ) {
      $this->ALLOWED_EXPORT_INVOICE_TYPES = Config::$ALLOWED_EXPORT_INVOICE_TYPES;
      $this->items = $items;
      $this->setExportType($exportType);
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

   private function setExportType($exportType)
   {
      if (! array_key_exists($exportType, $this->ALLOWED_EXPORT_INVOICE_TYPES)) {
         throw new Exception("Invalid export type");
      }
      $this->exportType = $this->ALLOWED_EXPORT_INVOICE_TYPES[$exportType];
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