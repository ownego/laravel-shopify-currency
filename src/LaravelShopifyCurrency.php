<?php

namespace Ownego\LaravelShopifyCurrency;

use Illuminate\Support\Facades\Cache;

class LaravelShopifyCurrency
{
    /**
     * Convert currency
     *
     * @param $amount
     * @param $from
     * @param $to
     * @return float|int
     */
    public function convert($amount, $from, $to)
    {
        $currencies = $this->get();
        $from = strtoupper($from);
        $to = strtoupper($to);
        $from_rate = isset($currencies[$from]) ? $currencies[$from] : 1;
        $to_rate = isset($currencies[$to]) ? $currencies[$to] : 1;

        return ($amount * $currencies[$from]) / $currencies[$to];
    }

    /**
     * Get currencies from cache
     *
     * @return mixed
     */
    public function get()
    {
        return Cache::remember(
            config('shopify-currency.cache-key'),
            config('shopify-currency.cache-ttl'),
            function () {
                return $this->fetch();
            }
        );
    }

    /**
     * Fetch currencies
     *
     * @return mixed
     */
    public function fetch()
    {
        try {
            $js = file_get_contents(config('shopify-currency.url'));
            $pattern = '/rates:(.*})/m';

            preg_match_all($pattern, $js, $matches);

            return json_decode($matches[1][0], JSON_OBJECT_AS_ARRAY);
        } catch (\Exception $e) {
            return [];
        }
    }
}