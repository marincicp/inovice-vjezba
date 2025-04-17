<?php

namespace App\Core;

class Validator
{


   public static function string(string $value, int $min = 1, int $max = 50): bool
   {
      $value = strlen(trim($value));

      return  $value >= $min  && $value <= $max;
   }



   public static function isFloat(float $value): bool
   {
      return is_float($value);
   }

   public static function email($value)
   {
      return filter_var($value, FILTER_VALIDATE_EMAIL);
   }
}
