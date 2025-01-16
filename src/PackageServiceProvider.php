<?php

namespace Sindor\LaravelCode;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Sindor\LaravelCode\App\Livewire\NewTableFormComponent;

class PackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'laravel-code');
        Livewire::component('laravel-code::new-table-form-component', NewTableFormComponent::class);

        $this->publishes([
            __DIR__ . '/config/laravel-code.php' => config_path('laravel-code.php'),
            __DIR__ . '/stubs' => base_path('stubs/laravel-code'),
            __DIR__ . '/resources/css/bootstrap.min.css' => public_path('css/laravel-code/bootstrap.min.css'),
            __DIR__ . '/resources/js/bootstrap.min.js' => public_path('js/laravel-code/bootstrap.min.js'),
        ], 'laravel-code');
    }
}
