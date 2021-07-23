<?php

namespace Ownego\LaravelShopifyCurrency\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Ownego\LaravelShopifyCurrency\LaravelShopifyCurrency;

class CacheShopifyCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "shopify-currency:cache";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache shopify\'s currencies';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(LaravelShopifyCurrency $currency)
    {
        $this->info('Caching currencies');
        $data = $currency->fetchRates();

        Cache::put(config('shopify-currency.cache-key'), $data, config('shopify-currency.cache-ttl'));

        $this->info('Cached');
    }
}