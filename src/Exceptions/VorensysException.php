<?php

namespace Lettingbox\Vorensys\Exceptions;

use Exception;

class VorensysException extends Exception
{
    public static function couldNotConnect()
    {
        return new static('Could not connect to vorensys api');
    }

    public static function serviceReturnedError(string $message)
    {
        return new static("Vorensys failed because `{$message}`");
    }
}
