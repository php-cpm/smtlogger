<?php

namespace SmtLogger\Monolog\Processor;

/**
 * machine name to trace where log came from
 * @author zouyi
 */
class HostNameProcessor
{

    public function __invoke(array $record)
    {
        $record['extra']['host'] = gethostname();
        return $record;
    }

}
