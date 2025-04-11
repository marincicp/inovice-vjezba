<?php

namespace App\Core;


function formatPrice(int $amount): float
{
   return round($amount / 100, 2);
}
