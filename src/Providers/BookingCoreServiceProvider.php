<?php

namespace TheRealJanJanssens\BookingCore\Providers;

use Illuminate\Support\ServiceProvider;

class BookingCoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        //Autoload migrations
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

        // Publish migrations and seeders
        $this->publishesMigrations([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'booking-core-migrations');

        //Seeder
        $this->publishes([
            __DIR__.'/../../database/seeders/DatabaseSeeder.php' => base_path('database/seeders/DatabaseSeeder.php'),
        ], 'booking-core-seeder');

        //Config
        $this->publishes([
            __DIR__.'/../../config/booking-core.php' => config_path('booking-core.php'),
        ], 'booking-core-config');

        $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
    }

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
    }

    // public static function allMigrations()
    // {
    //     $path = __DIR__ . '/../database/migrations';
    //     $files = array_values(array_diff(scandir($path), ['.', '..','.DS_Store']));

    //     for ($i = 0; $i < count($files); ++$i) {
    //         $result[$i] = str_replace('.php.stub', '', $files[$i]);
    //     }

    //     return $result;
    // }
}
