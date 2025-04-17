<?php

namespace App\Interfaces;

interface SubjectInterface
{
   public function attach(ObserverInterface $observer): void;
   public function detach(ObserverInterface $eventData): void;
   public function detachAll(): void;
   public function notify($eventData): void;
}
