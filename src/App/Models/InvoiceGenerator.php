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


      echo $this->exporter->export($this->invoice) . $this->notificationMessage($this->exporter->getName());
   }



   private function notificationMessage($exportType)
   {

      return match ($exportType) {
         "pdf" => 'FROM GENERATOR: The invoice has been saved in the "public/invoice_pdf" folder.',
         "html" => "-- THIS INVOICE IS FROM GENERATOR --"
      };
   }
}