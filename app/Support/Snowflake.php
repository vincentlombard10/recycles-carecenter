<?php

namespace App\Support;

class Snowflake
{
    // Custom epoch (January 1, 2021)
    protected static int $epoch = 1609459200000;

    protected static int $workerId = 1;    // 5 bits (0–31)
    protected static int $datacenterId = 1; // 5 bits (0–31)
    protected static int $sequence = 0;     // 12 bits
    protected static int $lastTimestamp = -1;

    public static function generate(): int
    {
        $timestamp = self::currentTime();

        if ($timestamp < self::$lastTimestamp) {
            throw new \RuntimeException("Clock moved backwards");
        }

        if ($timestamp === self::$lastTimestamp) {
            self::$sequence = (self::$sequence + 1) & 0xFFF; // 12-bit mask

            if (self::$sequence === 0) {
                $timestamp = self::waitNextMillis($timestamp);
            }
        } else {
            self::$sequence = 0;
        }

        self::$lastTimestamp = $timestamp;

        return (($timestamp - self::$epoch) << 22)
            | (self::$datacenterId << 17)
            | (self::$workerId << 12)
            | self::$sequence;
    }

    protected static function currentTime(): int
    {
        return (int) floor(microtime(true) * 1000);
    }

    protected static function waitNextMillis($timestamp): int
    {
        while ($timestamp == self::$lastTimestamp) {
            $timestamp = self::currentTime();
        }
        return $timestamp;
    }
}
