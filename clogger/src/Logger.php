<?php

namespace Clogger;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

class Logger implements LoggerAwareInterface
{

    use LoggerAwareTrait;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->setLogger($logger);
    }

    /**
     * Logging with parsable emergency log.
     *
     * @param string $type
     * @param string|string[] $category
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function emergency($type, $category, $message, array $context = [])
    {
        $this->logger->emergency($this->makeParsableMessage($type, $category) . $message, $context);
    }

    /**
     * Logging with parsable alert log.
     *
     * @param string $type
     * @param string|string[] $category
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function alert($type, $category, $message, array $context = [])
    {
        $this->logger->alert($this->makeParsableMessage($type, $category) . $message, $context);
    }

    /**
     * Logging with parsable critical log.
     *
     * @param string $type
     * @param string|string[] $category
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function critical($type, $category, $message, array $context = [])
    {
        $this->logger->critical($this->makeParsableMessage($type, $category) . $message, $context);
    }

    /**
     * Logging with parsable error log.
     *
     * @param string $type
     * @param string|string[] $category
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function error($type, $category, $message, array $context = [])
    {
        $this->logger->error($this->makeParsableMessage($type, $category) . $message, $context);
    }

    /**
     * Logging with parsable warning log.
     *
     * @param string $type
     * @param string|string[] $category
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function warning($type, $category, $message, array $context = [])
    {
        $this->logger->warning($this->makeParsableMessage($type, $category) . $message, $context);
    }

    /**
     * Logging with parsable notice log.
     *
     * @param string $type
     * @param string|string[] $category
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function notice($type, $category, $message, array $context = [])
    {
        $this->logger->notice($this->makeParsableMessage($type, $category) . $message, $context);
    }

    /**
     * Logging with parsable info log.
     *
     * @param string $type
     * @param string|string[] $category
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function info($type, $category, $message, array $context = [])
    {
        $this->logger->info($this->makeParsableMessage($type, $category) . $message, $context);
    }

    /**
     * Logging with parsable debug log.
     *
     * @param string $type
     * @param string|string[] $category
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function debug($type, $category, $message, array $context = [])
    {
        $this->logger->debug($this->makeParsableMessage($type, $category) . $message, $context);
    }

    /**
     * Logging with parsable log to received level.
     *
     * @param mixed $level
     * @param string $type
     * @param string|string[] $category
     * @param string $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function log($level, $type, $category, $message, array $context = [])
    {
        $this->logger->log($level, $this->makeParsableMessage($type, $category), $context);
    }

    public function makeParsableMessage($type, $category)
    {
        if (is_array($category)) {
            $category = implode('.', $category);
        }

        return "[{$type}:{$category}]";
    }
}
