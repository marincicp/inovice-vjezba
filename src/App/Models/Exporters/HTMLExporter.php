<?php

namespace App\Models\Exporters;

use App\Interfaces\InvoiceExporterInterface;
use App\Models\Invoice;

final class HTMLExporter implements InvoiceExporterInterface
{
   public function  export(Invoice $invoice): string
   {

      return "invoice html";
   }
}
