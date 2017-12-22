<?php

namespace SmtLogger\Monolog\Processor;

/**
 * generate a requestId for each request
 * to make it clear when logs look same
 *
 * @author php-cpm
 */
class RequestIdProcessor
{
    private static $requestId = null;

    private static function getRequestId()
    {
        if (self::$requestId === null) {
            self::$requestId = self::generateRequestId();
        }

        return self::$requestId;
    }

    /**
     * BASED ON SERVER REQUEST TIME
     * The timestamp of the start of the request, with microsecond precision. Available since PHP 5.4.0.
     * @return string
     */
    private static function generateRequestId()
    {
        return substr(md5($_SERVER['REQUEST_TIME_FLOAT']), 0, 6);
    }

    public function __invoke(array $record)
    {
        $record['extra']['rid'] = self::getRequestId();

        return $record;
    }
}
