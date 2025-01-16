<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Classes\Database\Column;
use Sindor\LaravelCode\App\Contracts\StubServiceContract;
use Sindor\LaravelCode\App\Traits\HasColumns;

class DTOService extends BaseStubService implements StubServiceContract
{
    use HasColumns;

    public function getStubPath(): string
    {
       return base_path('stubs/laravel-code/dto.stub');
    }

    public function getStubContent(): array
    {
        return $this->data;
    }

    public function getSavePath(): string
    {
        return config('laravel-code.dto.path');
    }

    public function getFileName(): string
    {
        return $this->data['CLASS_NAME'] . '.php';
    }

    public function init(): static
    {
        $this->data['NAMESPACE'] = config('laravel-code.dto.namespace');
        $txt = '';
        foreach ($this->columns as $key => $column){ /* @var $column Column*/
            $txt .= PHP_EOL . chr(9) . chr(9);
            $txt .= "public " . (($column->isNullable()) ? "?" : "") . $column->getType()->getProperty() . " $" . $column->getName()
                . (($column->hasDefault()) ? " = " . $column->getDefaultAsString() : "")
                . ($key === array_key_last($this->columns) ? '' : ',');
        }
        $this->data['PROPERTIES'] = $txt;
        return $this;
    }
}
