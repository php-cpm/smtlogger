# SmtLogger

when using frameworks we found it is hard to extend local loggers

after all, we need to write logs to many paths for each own business

so this came out

## Versions

- 1.X for monolog 1.X and php 5.6+
- 2.X for monolog 2.X and php 7.3+
 
## Processors

 - HostNameProcessor logs machine name
 - HostProcessor logs machine ipv4 address, it is likely to be a internal ip
 - RequestIdProcessor logs a special id for each request
 
 3 simple Processors to make each log more readable on large scale applications
 
## HOW TO USE

```
use SmtLogger\Logger;

Logger::getDefaultLogger()->addInfo('WHATEVER U WANT TO LOG IN A LINE OF STRING');
```

you may set PHP environment variables `SMT_LOG_PATH` and `SMT_EXCEPTION_LOG_PATH` to
move logs to other paths,may be use `dotEnv`

```
SMT_LOG_PATH=/tmp/my_logs/
```

you may extends `SmtLogger\SmtLogger` to make your own Logger

