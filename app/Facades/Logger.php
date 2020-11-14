<?php

namespace App\Facades;

use Clogger\Logger as CloggerLogger;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void emergency($type, $category, $message, array $context = [])
 * @method static void alert($type, $category, $message, array $context = [])
 * @method static void critical($type, $category, $message, array $context = [])
 * @method static void emergency($type, $category, $message, array $context = [])
 * @method static void error($type, $category, $message, array $context = [])
 * @method static void warning($type, $category, $message, array $context = [])
 * @method static void notice($type, $category, $message, array $context = [])
 * @method static void info($type, $category, $message, array $context = [])
 * @method static void debug($type, $category, $message, array $context = [])
 * @method static void log($level, $type, $category, $message, array $context = [])
 */
class Logger extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CloggerLogger::class;
    }
}
