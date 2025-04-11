<?php

namespace App\Core;

date_default_timezone_set('Europe/Zagreb');
function formatPrice(int $amount): float
{
   return round($amount / 100, 2);
}


function formatedDate()
{
   return date("Y-m-d H:i:s");
}



function dd($value)
{
   echo  "<pre>";
   var_dump($value);
   echo "</pre>";
}
