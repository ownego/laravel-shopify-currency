<?php

namespace Ownego\LaravelShopifyCurrency;

use Illuminate\Support\Facades\Cache;

class LaravelShopifyCurrency
{
    protected $rates;

    public function __construct()
    {
        $this->rates = Cache::remember(
            config('shopify-currency.cache-key'),
            config('shopify-currency.cache-ttl'),
            function () {
                return $this->fetchRates();
            }
        );
    }

    /**
     * Convert currency
     *
     * @param $amount
     * @param $from
     * @param $to
     * @return float|int
     */
    public function convert($amount, $from, $to = 'usd')
    {
        $result = $amount * $this->rate($from, $to);

        if (($precision = config('shopify-currency.round-precision')) !== null) {
            return round($result, $precision);
        }

        return $result;
    }

    /**
     * Get rate
     *
     * @param $from
     * @param $to
     * @return float|int
     */
    public function rate($from, $to = 'usd')
    {
        $from = strtoupper($from);
        $to = strtoupper($to);
        $from_rate = isset($this->rates[$from]) ? $this->rates[$from] : 1;
        $to_rate = isset($this->rates[$to]) ? $this->rates[$to] : 1;

        return $from_rate / $to_rate;
    }

    /**
     * Get currencies from cache
     *
     * @return mixed
     */
    public function getRates()
    {
        return $this->rates;
    }

    /**
     * Fetch rates
     *
     * @return mixed
     */
    public function fetchRates()
    {
        try {
            $js = file_get_contents(config('shopify-currency.url'));
            $pattern = '/rates:{(.*)},/m';

            preg_match_all($pattern, $js, $matches);

            $rates = explode(',', $matches[1][0]);
            $result = [];

            foreach ($rates as $rate) {
                $data = explode(':', $rate);

                $result[$data[0]] = $data[1];
            }

            return $result;
        } catch (\Exception $e) {
            return [];
        }
    }
}