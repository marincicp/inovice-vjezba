<?php

namespace App\Models;

use App\Interfaces\InvoiceExporterInterface;
use App\Models\Invoice;

class InvoiceGenerator

{
   private Invoice $invoice;
   private InvoiceExporterInterface $exporter;

   public function __construct(Invoice $invoice)
   {

      $this->invoice = $invoice;
      $this->exporter = new $invoice->exportType;


      echo $this->exporter->export($this->invoice) . " --THIS INVOICE IS FROM GENERATOR--";
   }
}
