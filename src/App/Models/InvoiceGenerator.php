<?php

namespace App\Models;

use App\Interfaces\InvoiceExporterInterface;
use App\Models\Invoice;

class InvoiceGenerator

{
   private Invoice $invoice;
   private InvoiceExporterInterface $exporter;

   public function __construct(Invoice $invoice, InvoiceExporterInterface $exporter)
   {

      $this->invoice = $invoice;
      $this->exporter = $exporter;


      echo $this->exporter->export($this->invoice) . " from generator";
   }
}
