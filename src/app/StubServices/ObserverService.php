<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Contracts\StubServiceContract;

class ObserverService extends BaseStubService implements StubServiceContract
{
    public function getStubPath(): string
    {
       return base_path('stubs/laravel-code/observer.stub');
    }

    public function getStubContent(): array
    {
        return $this->data;
    }

    public function getSavePath(): string
    {
        return config('laravel-code.observer.path');
    }

    public function getFileName(): string
    {
        return $this->data['CLASS_NAME'] . '.php';
    }

    public function init(): static
    {
        $this->data['NAMESPACE'] = config('laravel-code.observer.namespace');
        $this->data['MODEL_NAMESPACE'] = config('laravel-code.model.namespace');
        $this->data['VARIABLE'] = str($this->data['MODEL_NAME'])->camel()->singular();
        return $this;
    }
}
