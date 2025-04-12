<?php

namespace App\Models\Exporters;

use App\Interfaces\InvoiceExporterInterface;
use App\Models\Invoice;
use App\Models\Store;

use function App\Core\formatedDate;

final class HTMLExporter implements InvoiceExporterInterface
{
   private Store $store;



   public function __construct()
   {
      $this->store = Store::getInstance();
   }

   public function export(Invoice $invoice)
   {
      $this->renderTable($invoice);
   }

   private function renderTable($invoice)
   {
      echo "<div style='border:1px solid black; width: max-content; padding:10px' >";
      $this->storeInfo();
      echo "<table border=1 cellpadding=10 > ";
      $this->renderTableHeader();
      echo "<tbody>";
      $this->renderTableRow($invoice->getItems());
      echo "</tbody>";
      $this->renderTableFooter($invoice);
      echo "</table>";
      echo "</div>";
   }

   private function storeInfo()
   {
      echo "<h2>" . $this->store->getName()  . "</h2>";
      echo $this->store->getLocation() . " - " . formatedDate() . "h";
   }

   private function renderTableHeader()
   {
      echo "<thead><tr>";
      echo "<th  align='center'  scope='col'>Product</th>";
      echo "<th scope='col'>Price</th>";
      echo "</tr> </thead>";
   }


   private function renderTableRow($items)
   {
      foreach ($items as $item) {
         echo "<tr>";
         echo "<td align='center' scope='row'>" . $item['name'] . "</td>";
         echo "<td align='center' scope='row'>" . $item['price'] . "$</td>";
         echo "</tr>";
      };
   }


   private function renderTableFooter($invoice)
   {
      echo "  <tfoot><tr>";
      echo "<th align='center' scope='row' >Total:</th>";
      echo "<td align='center'>" . $invoice->getSum() . "$ </td>";
      echo " </tr> </tfoot>";
   }
}
