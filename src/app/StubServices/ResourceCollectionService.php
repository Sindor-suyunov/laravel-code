<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Contracts\StubServiceContract;
use Sindor\LaravelCode\App\Traits\HasColumns;

class ResourceCollectionService extends BaseStubService implements StubServiceContract
{
    use HasColumns;

    public function getStubPath(): string
    {
       return base_path('stubs/laravel-code/resource-collection.stub');
    }

    public function getStubContent(): array
    {
        return $this->data;
    }

    public function getSavePath(): string
    {
        return config('laravel-code.json_resource.path');
    }

    public function getFileName(): string
    {
        return $this->data['CLASS_NAME'] . '.php';
    }

    public function init(): static
    {
        $this->data['NAMESPACE'] = config('laravel-code.json_resource.namespace');
        $this->data['MODEL_NAMESPACE'] = config('laravel-code.model.namespace');
        return $this;
    }
}
