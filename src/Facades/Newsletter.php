<?php

namespace Delta935142\Mitake\Facades;

use Illuminate\Support\Facades\Facade;

Class Newsletter extends Facade
{
    /**
     * 取得註冊名稱
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \Delta935142\Mitake\Newsletter::class;
    }
}