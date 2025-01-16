<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Classes\Database\Column;
use Sindor\LaravelCode\App\Contracts\StubServiceContract;
use Sindor\LaravelCode\App\Enums\ColumnTypeEnum;
use Sindor\LaravelCode\App\Traits\HasColumns;

class FactoryService extends BaseStubService implements StubServiceContract
{
    use HasColumns;

    public function getStubPath(): string
    {
        return base_path('stubs/laravel-code/factory.stub');
    }

    public function getStubContent(): array
    {
        return $this->data;
    }

    public function getSavePath(): string
    {
        return config('laravel-code.factory.path');
    }

    public function getFileName(): string
    {
        return $this->data['CLASS_NAME'].'.php';
    }

    public function init(): static
    {
        $this->data['NAMESPACE'] = config('laravel-code.factory.namespace');
        $this->data['MODEL_NAMESPACE'] = config('laravel-code.model.namespace');

        $txt = '';
        foreach ($this->columns as $key => $column) { /* @var $column Column */
            $txt .= PHP_EOL . chr(9) . chr(9) . chr(9);
            $txt .= "'".$column->getName()."' => " . '$this->faker->' . $this->getFakerMethodByName($column->getName(), $column->getType());
            $txt .= ((array_key_last($this->columns) == $key) ? '' : ',');
        }

        $this->data['FIELDS'] = $txt;

        return $this;
    }

    private function getFakerMethodByName(string $name, ColumnTypeEnum $type): string
    {
        $camelCaseName = str($name)->camel();

        $faker = fake();
        if (method_exists($faker, $camelCaseName)) {
            return "$camelCaseName()";
        }

        if (str_contains($name, 'name')) {
            return "name()";
        }

        if (str_contains($name, 'description')) {
            return "sentence()";
        }

        if (str_contains($name, 'token')) {
            return "\Str::random()";
        }

        return $type->getFakerMethod() . "()";
    }
}
