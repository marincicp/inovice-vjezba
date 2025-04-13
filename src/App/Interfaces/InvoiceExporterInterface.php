<?php

namespace App\Interfaces;

use App\Models\Invoice;

interface InvoiceExporterInterface
{
   public function  export(Invoice $invoice);

   public function getName(): string;
}