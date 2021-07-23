<?php

namespace Ownego\LaravelShopifyCurrency\Facades;

use Illuminate\Support\Facades\Facade;

class ShopifyCurrency extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'shopify-currency';
    }
}