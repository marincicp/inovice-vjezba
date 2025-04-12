<?php

namespace App\Core;

use App\Models\Exporters\HTMLExporter;
use App\Models\Exporters\PDFExporter;
use App\Models\Payments\CardPayment;
use App\Models\Payments\CashPayment;

class Config
{

   public static string $storeName = "Super Store";
   public static string $storeLocation = "Zagreb";

   public static array $ALLOWED_PAYMENT_METHODS =  [
      "card" => CardPayment::class,
      "cash" => CashPayment::class
   ];


   public static array  $ALLOWED_EXPORT_INVOICE_TYPES = [
      "html" => HTMLExporter::class,
      "pdf" => PDFExporter::class,
   ];

   private function __construct() {}
}
