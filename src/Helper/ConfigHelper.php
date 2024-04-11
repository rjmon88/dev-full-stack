<?php

namespace DevFullStack\Helper;

use DateTime;
use DateTimeZone;

class ConfigHelper
{
    public static function getConnectionParams(): ?array
    {
        if (defined('CONNECTION_PARAMS')) {
            return CONNECTION_PARAMS;
        }
        return null;
    }
    public static function isDevMode(): bool
    {
        if (defined('IS_DEV_MODE')) {
            return IS_DEV_MODE;
        }
        return false;
    }

    public static function getTimeZone(): ?string
    {
        if (defined('TIME_ZONE')) {
            return TIME_ZONE;
        }
        return 'America/Sao_Paulo';
    }

    public static function setTimeZone(): void
    {
        date_default_timezone_set(self::getTimeZone());
    }
}