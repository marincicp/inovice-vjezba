<?php

namespace App\Models;

use App\Core\Config;
use App\Interfaces\InvoiceExporterInterface;
use App\Models\Exporters\ExportInvoiceFactory;
use App\Models\Invoice;
use App\Models\Payments\Payment;
use Exception;

class InvoiceGenerator

{
   private Invoice $invoice;
   private InvoiceExporterInterface $exporter;
   private Payment $payment;

   public function __construct(Customer $customer, Invoice $invoice, string $paymentMethod, string $exportType)
   {
      $this->onInit($invoice, $exportType);

      $this->payment->proccessPayment($customer, $invoice, $paymentMethod);

      $this->exportInvoice();
   }


   private function onInit(Invoice $invoice, string $exportType)
   {
      $this->payment = new Payment();
      $this->invoice = $invoice;
      $this->exporter = $this->setExporter($exportType);
   }

   private function setExporter($exportType)
   {
      if (! array_key_exists($exportType, Config::$ALLOWED_EXPORT_INVOICE_TYPES)) {
         throw new Exception("Invalid export type");
      }

      return ExportInvoiceFactory::create($exportType);
   }


   private function exportInvoice()
   {
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
