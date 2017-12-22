<?php
/**
 *  SmartLogger based on monolog
 *
 * User: zouyi
 * Date: 2017-10-27 10:56
 */

namespace SmtLogger;

class Logger extends SmtLogger
{
    public static $defaultPath = 'logs/';

    const USE_EXCEPTION_PATH = true;

    /**
     *
     * @return \Monolog\Logger
     */
    public static function getRequestLogger()
    {
        $config = [
            'log_path' => self::getLogPath() . "request_" . date("Ymd") . ".log"
        ];

        return self::getLogger('request', $config);
    }

    /**
     *
     * @return \Monolog\Logger
     */
    public static function getApiLogger()
    {
        $config = [
            'log_path' => self::getLogPath() . "api_" . date("Ymd") . ".log"
        ];

        return self::getLogger('api', $config);
    }

    /**
     *
     * @return \Monolog\Logger
     */
    public static function getCacheLogger()
    {
        $config = [
            'log_path' => self::getLogPath() . "cache_" . date("Ymd") . ".log"
        ];

        return self::getLogger('cache', $config);
    }

    /**
     *
     * @return \Monolog\Logger
     */
    public static function getDefaultLogger()
    {
        $config = [
            'log_path' => self::getLogPath() . "default_" . date("Ymd") . ".log"
        ];

        return self::getLogger('normal', $config);
    }

    /**
     *
     * @return \Monolog\Logger
     */
    public static function getExceptionLogger()
    {
        $config = [
            'log_path' => self::getLogPath(self::USE_EXCEPTION_PATH) . "Exception_" . date("Ymd") . ".log"
        ];

        return self::getLogger('exception', $config);
    }

    public static function getLogPath($useExceptionPath = false)
    {
        if ($useExceptionPath) {
            $path = getenv('SMT_EXCEPTION_LOG_PATH') ? getenv('SMT_EXCEPTION_LOG_PATH') : getenv('SMT_LOG_PATH');
        } else {
            $path = getenv('SMT_LOG_PATH');
        }

        return $path ? $path : static::$defaultPath;
    }
}
