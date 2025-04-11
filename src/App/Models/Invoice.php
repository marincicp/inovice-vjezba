<?php

namespace App\Models;

use App\Models\Exporters\HTMLExporter;
use App\Models\Exporters\PDFExporter;

use Exception;
use function App\Core\formatPrice;


class Invoice
{
   private array $items = [];
   public string $exportType = "";
   private const  ALLOWED_EXPORT_INVOICE_TYPE = [
      "html" => HTMLExporter::class,
      "pdf" => PDFExporter::class,
   ];
   public function __construct(
      array  $items,
      string $exportType
   ) {
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
      if (! array_key_exists($exportType, self::ALLOWED_EXPORT_INVOICE_TYPE)) {
         throw new Exception("Invalid export type");
      }
      $this->exportType = self::ALLOWED_EXPORT_INVOICE_TYPE[$exportType];
   }
}
