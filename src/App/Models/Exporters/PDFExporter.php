<?php

namespace App\Models\Exporters;

use App\Core\Config;
use App\Interfaces\InvoiceExporterInterface;
use App\Models\Invoice;
use App\Models\Store;
use FPDF;

use function App\Core\formatedDate;

require_once "src/fpdf/fpdf.php";


final class PDFExporter  implements InvoiceExporterInterface
{
   private const NAME = "pdf";

   private Store $store;
   private  FPDF $pdf;


   public function __construct()
   {
      $this->store = Store::getInstance();
      $this->pdf = new FPDF();
   }


   public function getName(): string
   {
      return self::NAME;
   }

   public function export(Invoice $invoice)
   {
      $this->generateInvoice($invoice);
      $this->savePDF();
   }

   private function generateInvoice($invoice)
   {
      $this->pdf->addPage();
      $this->generateStoreInfo();
      $this->generateHeader();
      $this->generateProductRows($invoice);
      $this->generateTotalRow($invoice);
   }
   private function generateStoreInfo()
   {
      $this->pdf->SetFont("Arial", "B", 26);
      $this->pdf->Cell(0, 10, $this->store->getName(), 0, 1, 'C');
      $this->pdf->Ln(10);
      $this->pdf->SetFont("Arial", "B", 14);
      $this->pdf->Cell(0, 10, "Location: " . $this->store->getLocation(), 0, 0, 'L');
      $this->pdf->Cell(0, 10,  "Date: " . formatedDate() . "h", 0, 0, 'R');
      $this->pdf->Ln(10);
   }



   private function generateHeader()
   {
      $header = ["PRODUCT", "PRICE"];

      $this->pdf->SetFont("Arial", "B", 16);
      $this->pdf->Ln(10);
      foreach ($header as $col) {
         $this->pdf->Cell(40, 12, $col, 1);
      }
   }


   private function generateProductRows($invoice)
   {
      $products = $invoice->getItems();

      $this->pdf->Ln();
      foreach ($products as $product) {
         $this->pdf->Cell(40, 12, $product["name"], 1);
         $this->pdf->Cell(40, 12, $product["price"] . "$", 1);
         $this->pdf->Ln();
      }
   }
   private function generateTotalRow($invoice)
   {
      $this->pdf->Cell(40, 12, "TOTAL:", 1);
      $this->pdf->Cell(40, 12, $invoice->getSum() . "$", 1);
      $this->pdf->Ln();
      $this->pdf->Cell(0, 10,  "Payment method: " . $invoice->getPaidBy(), 0, 0, 'R');
      $this->pdf->Ln(10);
   }


   private function savePDF()
   {
      $filename =  Config::$INVOICE_PDF_DIR_PATH . "invoice-" . date('d-m-Y-H-i-s') . ".pdf";
      $this->pdf->Output("F", $filename);
   }
}