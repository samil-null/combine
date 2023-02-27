<?php

namespace App\Providers;

use ClickHouseDB\Client;
use Illuminate\Support\ServiceProvider;

class ClickHouseClientProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(Client::class, function () {
            $client = new Client([
                'host' => config('clickhouse.host'),
                'port' => config('clickhouse.port'),
                'username' => config('clickhouse.username'),
                'password' => config('clickhouse.password')
            ]);

            return $client->database(config('clickhouse.database'));
        });
    }
}
