<?php

namespace App\Interfaces;

interface ObserverInterface
{
   public  function update($eventData): void;
}
