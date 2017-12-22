<?php
/**
 *  SmartLogger based on monolog
 *
 * User: zouyi
 * Date: 2017-10-27 10:56
 */

namespace SmtLogger;

use Monolog\Formatter\LineFormatter;
use Monolog\Logger as MonoLogger;
use Monolog\Handler\StreamHandler;
use SmtLogger\Monolog\Processor\HostProcessor;
use SmtLogger\Monolog\Processor\RequestIdProcessor;

class SmtLogger
{
    const DEFAULT_HANLDER = 'StreamHandler';

    /**
     * @var \Monolog\Logger
     */
    static protected $loggers = [];

    private static $dateFormat = 'Ymd';

    /**
     *
     * @param string $channel
     * @param array $config
     *
     * @return \Monolog\Logger
     */
    public static function getLogger($channel, $config = [])
    {
        if (! isset(self::$loggers[$channel])
            || (isset(self::$loggers[$channel]) && self::$loggers[$channel]['at'] != date(self::$dateFormat))
        ) {
            self::$loggers[$channel] = [
                'at'     => date(self::$dateFormat),
                'logger' => self::initLogger($channel, $config)
            ];
        }

        return self::$loggers[$channel]['logger'];
    }

    protected static function initLogger($channel, $config = [])
    {
        $logger = new MonoLogger($channel);
        $logger->pushProcessor(new HostProcessor());
        $logger->pushProcessor(new RequestIdProcessor());
        // equals to $output = "[%datetime%]%extra%%channel%.%level_name%: %message% %context%\n";
        $output = null;
        $formatter = new LineFormatter($output);
        //
        if (! isset($config['log_path'])) {
            $config['log_path'] = 'mono.log';
        }
        if (! isset($config['log_min_level'])) {
            $config['log_min_level'] = MonoLogger::INFO;
        }
        $stream = new StreamHandler($config['log_path'], $config['log_min_level']);
        $stream->setFormatter($formatter);
        $logger->pushHandler($stream);

        return $logger;
    }
}
