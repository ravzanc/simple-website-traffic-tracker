<?php

declare(strict_types=1);

namespace App\Helper;

use DateInterval;
use DateTime;

class DateTimeService
{
    public static function handleTimeZoneOffset(string $dateTime, string $tzOffset): DateTime
    {
        $dateTime = DateTime::createFromFormat('Y-m-d H:i', $dateTime);

        try {
            if (str_starts_with($tzOffset, '-')) {
                return $dateTime->sub(
                    new DateInterval('PT' . intval(substr($tzOffset, 1)) . 'H')
                );
            }

            return $dateTime->add(
                new DateInterval('PT' . intval($tzOffset) . 'H')
            );
        } finally {
            return $dateTime;
        }
    }

    public static function convertUTCTimeZoneOffset(string $tzOffset): string
    {
        $convertOffset = intval($tzOffset) * (-1);

        return sprintf(
            '%s%02d:00',
            $convertOffset > 0 ? '+' : '-',
            abs($convertOffset)
        );
    }
}
