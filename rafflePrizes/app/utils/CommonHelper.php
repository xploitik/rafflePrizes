<?php

namespace RafflePrizes\utils;

class CommonHelper
{
    public const DEFAULT_DATETIME_FORMAT = 'Y-m-d H:i:s';
    /**
     * @param int $min
     * @param int|null $max
     * @return int
     */
    public static function random(int $min = 0, ?int $max = null): int
    {
        if (is_null($max)) {
            return rand($min);
        }

        return rand($min, $max);
    }

    public static function currentDateTime($format = null): string
    {
        $date = new \DateTime();
        if (empty($format)) {
            $format = self::DEFAULT_DATETIME_FORMAT;
        }
        return $date->format($format);
    }
}