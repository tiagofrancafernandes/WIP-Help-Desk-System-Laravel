<?php

use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;

return [
    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Laravel'),

    'logo_url' => env('APP_URL') . '/' . env('APP_LOGO', 'logo.png'),

    /**
     * Usage: <img src="data:image/png;base64,{{ config('app.logo_base64') }}" alt="Logo">
     * Generate a new value: str_split(base64_encode(file_get_contents(public_path('logo.png'))), 110)
     */
    'logo_base64' => implode('', [
        "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",
        "lFTkSuQmCC",
    ]),

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services the application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => (bool) env('APP_DEBUG', false),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    'asset_url' => env('ASSET_URL'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => env('APP_LOCALE', 'en'),

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Faker Locale
    |--------------------------------------------------------------------------
    |
    | This locale will be used by the Faker PHP library when generating fake
    | data for your database seeds. For example, this will be used to get
    | localized telephone numbers, street address information and more.
    |
    */

    'faker_locale' => 'en_US',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Maintenance Mode Driver
    |--------------------------------------------------------------------------
    |
    | These configuration options determine the driver used to determine and
    | manage Laravel's "maintenance mode" status. The "cache" driver will
    | allow maintenance mode to be controlled across multiple machines.
    |
    | Supported drivers: "file", "cache"
    |
    */

    'maintenance' => [
        'driver' => 'file',
        // 'store' => 'redis',
    ],

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => ServiceProvider::defaultProviders()->merge([
        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
    ])->toArray(),

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => Facade::defaultAliases()->merge([
        // 'Example' => App\Facades\Example::class,
    ])->toArray(),
];
