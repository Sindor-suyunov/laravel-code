<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Classes\Database\Column;
use Sindor\LaravelCode\App\Contracts\StubServiceContract;
use Sindor\LaravelCode\App\Traits\HasColumns;

class FormRequestService extends BaseStubService implements StubServiceContract
{
    use HasColumns;
    
    public function getStubPath(): string
    {
        return base_path('stubs/laravel-code/form-request.stub');
    }

    public function getStubContent(): array
    {
        return $this->data;
    }

    public function getSavePath(): string
    {
        return config('laravel-code.form_request.path');
    }

    public function getFileName(): string
    {
        return $this->data['CLASS_NAME'] . '.php';
    }

    public function init(): static
    {
        $this->data['NAMESPACE'] = config('laravel-code.form_request.namespace');
        $this->data['PARENT_CLASS'] = '\\'.config('laravel-code.form_request.parent_class');

        $txt = '';
        foreach ($this->columns as $key => $column){ /* @var $column Column */
            $txt .= PHP_EOL . chr(9) . chr(9) . chr(9);
            $txt .= "'{$column->getName()}' => '";
            $txt .= ($column->isNullable()) ? 'nullable|' : 'required|';
            $txt .= $column->getType()->getRule() . "'" . (($key) == array_key_last($this->columns) ? '' : ',');
        }

        $this->data['RULES'] = $txt;

        return $this;
    }
}
