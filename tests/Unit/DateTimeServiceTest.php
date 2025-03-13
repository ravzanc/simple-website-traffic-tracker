<?php

namespace Tests\Unit;

use App\Helper\DateTimeService;
use DateTime;
use Tests\TestCase;

class DateTimeServiceTest extends TestCase
{
    /**
     * @dataProvider provideTimeZoneOffsets
     */
    public function testConvertUTCTimeZoneOffset(string $tzOffset, string $convertedTsOffset): void
    {
        $this->assertEquals($convertedTsOffset, DateTimeService::convertUTCTimeZoneOffset($tzOffset));
    }

    /**
     * @dataProvider provideDateTimeZoneOffsets
     */
    public function testHandleTimeZoneOffset(string $ateTime, string $tzOffset, DateTime $handledDateTime): void
    {
        $this->assertEquals($handledDateTime, DateTimeService::handleTimeZoneOffset($ateTime, $tzOffset));
    }

    public static function provideDateTimeZoneOffsets(): array
    {
        return [
            [
                '2025-03-13 11:02', // Server datetime
                '-2', // Client timezone offset
                DateTime::createFromFormat('m/d/Y H:i', '03/13/2025 09:02'), // Client datetime
            ],
            [
                '2025-03-13 11:02',
                '+2',
                DateTime::createFromFormat('m/d/Y H:i', '03/13/2025 13:02'),
            ],
            [
                '2025-03-13 11:02',
                '-11',
                DateTime::createFromFormat('m/d/Y H:i', '03/13/2025 00:02'),
            ],
            [
                '2025-03-13 11:02',
                '+11',
                DateTime::createFromFormat('m/d/Y H:i', '03/13/2025 22:02'),
            ],
        ];
    }

    public static function provideTimeZoneOffsets(): array
    {
        return [
            [
                '-2', // Client timezone offset
                '+02:00', // Server timezone offset
            ],
            [
                '2',
                '-02:00',
            ],
            [
                '-11',
                '+11:00',
            ],
            [
                '11',
                '-11:00',
            ],
        ];
    }
}
