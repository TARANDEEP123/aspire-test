<?php

namespace App\Utility;

/**
 * Class DateUtil
 * @package App\Utility
 */
class DateUtil
{
    /**
     * Method give current date for e.g 2021-09-09
     * @return false|string
     */
    public static function getCurrentDate ()
    {
        return \date('Y-m-d');
    }

    /**
     * Method give current date for e.g 2021-09-09 12:01:12
     * @return false|string
     */
    public static function getCurrentTime ()
    {
        return \date('Y-m-d H:i:s');
    }
}
