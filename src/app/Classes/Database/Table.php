<?php

namespace Sindor\LaravelCode\App\Classes\Database;

use Sindor\LaravelCode\App\Contracts\TextContract;
use Sindor\LaravelCode\App\DTOs\FormDTO;
use Sindor\LaravelCode\App\Enums\ColumnTypeEnum;

class Table implements TextContract
{
    protected array $columns = [];

    public function __construct(
        protected string $name
    ) {
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    public function column(Column $column): static
    {
        $this->columns[] = $column;
        return $this;
    }

    public function columns(array $columns): static
    {
        $this->columns = $columns;
        usort($this->columns, function (Column $a, Column $b) {
            return $a->hasDefault() ? 1 : -1;
        });
        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function text(): string
    {
        return array_reduce($this->columns, function ($text, $column) {
            return $text.$column->text();
        }, '');
    }

    public static function fromDTO(FormDTO $data)
    {
        return static::make($data->table_name)
            ->columns(
                array_map(function ($column) {
                    return Column::make(ColumnTypeEnum::from($column['type']))
                        ->name($column['name'])
                        ->default($column['default'])
                        ->nullable(($column['nullable'] ?? 'off') == 'on')
                        ->unique(($column['unique'] ?? 'off') == 'on')
                        ->index(($column['index'] ?? 'off') == 'on');
                }, array_filter($data->columns, function ($value) {
                    return !empty($value['name']);
                }))
            );
    }
}
