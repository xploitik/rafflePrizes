<?php

namespace RafflePrizes\utils;

class SecurityHelper
{
    /**
     * @param string $string
     * @return string
     */
    public static function toHash(string $string): string
    {
        return md5($string);
    }
}