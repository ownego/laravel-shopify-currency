<?php

return [
    'url' => env('SHOPIFY_CURRENCY_URL', 'https://cdn.shopify.com/s/javascripts/currencies.js'),
    'cache-key' => env('SHOPIFY_CURRENCY_CACHE_KEY', 'shopify_currencies'),
    'cache-ttl' => env('SHOPIFY_CURRENCY_CACHE_TTL', 60),
];