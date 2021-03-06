<?php

namespace Lettingbox\Vorensys;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lettingbox\Vorensys\Vorensys
 */
class VorensysFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'vorensys';
    }
}
