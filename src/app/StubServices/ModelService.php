<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Classes\Database\Column;
use Sindor\LaravelCode\App\Contracts\StubServiceContract;
use Sindor\LaravelCode\App\Traits\HasColumns;

class ModelService extends BaseStubService implements StubServiceContract
{
    use HasColumns;

    public function getStubPath(): string
    {
        return base_path('stubs/laravel-code/model.stub');
    }

    public function getStubContent(): array
    {
        return $this->data;
    }

    public function getSavePath(): string
    {
        return config('laravel-code.model.path');
    }

    public function getFileName(): string
    {
        return $this->data['CLASS_NAME'].'.php';
    }

    public function init(): static
    {
        if (config('laravel-code.model.add_fillable')) {
            $txt = 'protected $fillable = [';
            foreach ($this->columns as $key => $column){
                /* @var $column Column */
                $txt .= PHP_EOL . chr(9) . chr(9) . "'{$column->getName()}'" . ($key === array_key_last($this->columns) ? '' : ',');
            }
            $txt .= PHP_EOL . chr(9) . '];';
            $this->data['FILLABLE'] = $txt;
            $txt = '';
        }

        if (config('laravel-code.model.add_casts')) {
            $txt = 'protected $casts = [';
            foreach ($this->columns as $key => $column){
                /* @var $column Column */
                if (!empty($cast = $column->getType()->getCast())) {
                    $txt .= PHP_EOL . chr(9) . chr(9) ."'{$column->getName()}:{$cast}'" . ($key === array_key_last($this->columns) ? '' : ',');
                }
            }
            $txt .=  PHP_EOL . chr(9) . '];';
            $this->data['CASTS'] = $txt;
            $txt = '';
        }

        $this->data['PARENT_CLASS'] = '\\' . config('laravel-code.model.parent_class');
        $this->data['NAMESPACE'] = config('laravel-code.model.namespace');

        return $this;
    }
}
