<?php

namespace App\Models;

use App\Core\Config;

class SendMail
{

   private Customer $customer;
   private string $content;
   private string $subject;

   public function __construct(Customer $customer, $eventData)
   {
      $this->customer = $customer;
      $this->content = $eventData["content"];
      $this->subject = $eventData["subject"];


      $this->send();
   }

   private function emailContent(): string
   {
      return
         "To: {$this->customer->getEmail()} 
              From: super@store.com 
              Subject:  {$this->subject}   
              Content: Hello {$this->customer->getName()},  {$this->content}";
   }

   private function send(): void
   {

      $filename = Config::$EMAIL_LOG_PATH . $this->customer->getEmail() . "-" . date('d-m-Y-H-i-s') . ".txt";

      file_put_contents($filename, $this->emailContent());
   }
}
