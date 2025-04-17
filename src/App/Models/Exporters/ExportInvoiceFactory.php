<?php


namespace App\Models\Exporters;

use Exception;

class ExportInvoiceFactory
{

   public static function create(string $exportType)
   {
      return match ($exportType) {
         "html" => new  HTMLExporter,
         "pdf" => new  PDFExporter,
         "default" => throw new Exception("Unknown export type ")
      };
   }
}
