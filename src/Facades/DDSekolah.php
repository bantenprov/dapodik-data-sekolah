<?php namespace Bantenprov\DDSekolah\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The DDSekolah facade.
 *
 * @package Bantenprov\DDSekolah
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class DDSekolah extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'dd-sekolah';
    }
}
