<?php

namespace App\Notifications;

use App\Interfaces\ObserverInterface;
use App\Interfaces\SubjectInterface;

class CouponEmailNotification implements SubjectInterface
{
   private $observers = [];

   public function attach(ObserverInterface $observer): void
   {
      $this->observers[] = $observer;
   }


   public function detach(ObserverInterface $observer): void
   {
      array_filter($this->observers, fn($obs) => $obs !== $observer);
   }


   public function detachAll(): void
   {
      $this->observers = [];
   }

   public function notify($eventData): void
   {
      foreach ($this->observers as $obs) {
         $obs->update($eventData);
      }
   }
}