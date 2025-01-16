<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Classes\Database\Column;
use Sindor\LaravelCode\App\Contracts\StubServiceContract;
use Sindor\LaravelCode\App\Traits\HasColumns;

class JsonResourceService extends BaseStubService implements StubServiceContract
{
    use HasColumns;

    public function getStubPath(): string
    {
       return base_path('stubs/laravel-code/json-resource.stub');
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
        $txt = '';
        foreach ($this->columns as $key => $column){ /* @var $column Column*/
            $txt .= PHP_EOL . chr(9) . chr(9) . chr(9);
            $txt .= "'".$column->getName()."'" . ' => $this->' . $column->getName()
                . ($key === array_key_last($this->columns) ? '' : ',');
        }
        $this->data['FIELDS'] = $txt;
        return $this;
    }
}
