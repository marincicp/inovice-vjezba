<?php

namespace App\Models\Exporters;

use App\Interfaces\InvoiceExporterInterface;
use App\Models\Invoice;

final class PDFExporter implements InvoiceExporterInterface
{
   public function export(Invoice $invoice): string
   {

      return "invoice pdf";
   }
}
