<?php

namespace App\Providers;

use App\Services\PrometheusService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Prometheus\CollectorRegistry;
use Prometheus\Storage\Adapter;
use Prometheus\Storage\Redis;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PrometheusService::class, PrometheusService::class);

        $this->app->bind(Adapter::class, function () {
            $conn = parse_url(config('database.redis.default'));
            return new Redis(
                [
                    'host' => $conn['host'],
                    'port' => $conn['port'] ?? 6379,
                    'password' => $conn['pass'],
                ]
            );
        });

        $this->app->singleton(CollectorRegistry::class, function () {
            return new CollectorRegistry($this->app->make(Adapter::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
