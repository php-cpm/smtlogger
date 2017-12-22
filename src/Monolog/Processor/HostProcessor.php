<?php

namespace SmtLogger\Monolog\Processor;

/**
 * machine IP to trace where log came from
 * @author zouyi
 */
class HostProcessor
{
    /**
     * sometimes mac os `gethostbyname` too slow
     * I used to set `APP_ENV` environment variable to `local`
     * @param array $record
     *
     * @return array
     */
    public function __invoke(array $record)
    {
        $record['extra']['ip'] = getenv('APP_ENV')=='local' ? 'LOCAL': gethostbyname(gethostname());
        return $record;
    }
}
