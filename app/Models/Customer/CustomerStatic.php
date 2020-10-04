<?php
namespace App\Models\Customer;

use App\Models\ReferenceAbstract;

class CustomerStatic extends ReferenceAbstract
{
    protected static $lists = [
        1 => 'General',
        2 => 'Perusahaan',
        3 => 'Reseller'
    ];

    public static function all()
    {
        return collect(static::toArray());
    }

    public static function getById($singleId)
    {

        if ($singleId && isset(static::$lists[$singleId])) {
            return static::$lists[$singleId];
        }

        return null;
    }


}
