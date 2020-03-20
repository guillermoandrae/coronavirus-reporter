<?php

namespace Guillermoandrae\Coronavirus\Helpers;

final class StringParser
{
    /**
     * Strips a number of characters from a string.
     *
     * @param string $string The string.
     * @return string The stripped string.
     */
    public static function stripChars(string $string): string
    {
        $characters = [',', '.', '&#160;', '&nbsp;', '&#58;', ':', '-'];
        return str_replace($characters, '', trim($string));
    }

    /**
     * Strips periods from ante and post meridiem strings.
     *
     * @param string $string The string.
     * @return string The stripped string.
     */
    public static function stripCharsMeridiem(string $string): string
    {
        return strtoupper(str_replace('.', '', $string));
    }
}
