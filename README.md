## Introduction
This package created for convert between 2 currencies by using currencies.js file provided by Shopify.
## Installation
1. Install package

    ```composer require ownego/laravel-shopify-currency```
2. Optional: add the service provider

   ```php
   'providers' => [
      // ...
      Ownego\LaravelShopifyCurrency\LaravelShopifyCurrencyServiceProvider::class,
   ],
   ```
3. Optional: publish config

   ```php artisan vendor:publish --provider=Ownego\LaravelShopifyCurrency\LaravelShopifyCurrencyServiceProvider```
4. Optional: add facade

   ```php
   'alias' => [
      // ...
      'ShopifyCurrency' => Ownego\LaravelShopifyCurrency\Facades\ShopifyCurrency::class,
   ],
   ```
## Usage
1. Convert
   ```php
   use Ownego\LaravelShopifyCurrency\Facades\ShopifyCurrency;

   $result = ShopifyCurrency::convert(100, 'eur', 'usd');
   ```
2. Get rate
   ```php
   use Ownego\LaravelShopifyCurrency\Facades\ShopifyCurrency;

   $result = ShopifyCurrency::rate('eur', 'usd');
   ```
