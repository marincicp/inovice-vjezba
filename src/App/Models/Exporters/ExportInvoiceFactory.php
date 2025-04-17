<?php


namespace App\Models\Exporters;


class ExportInvoiceFactory
{

   public static function create(string $exportType)
   {
      return match ($exportType) {
         "html" => new  HTMLExporter,
         "pdf" => new  PDFExporter,
      };
   }
}
