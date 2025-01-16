<?php

namespace Sindor\LaravelCode\App\Classes\Database;

use Sindor\LaravelCode\App\Contracts\TextContract;
use Sindor\LaravelCode\App\Enums\ColumnTypeEnum;

class Column implements TextContract
{
    protected string $name;
    protected mixed $default = null;
    protected bool $nullable = false;
    protected bool $unique = false;
    protected bool $index = false;

    protected string $text = '';

    public function __construct(
        protected ColumnTypeEnum $column_type
    )
    {
    }

    public static function make(ColumnTypeEnum $enum): static
    {
        return new static($enum);
    }

    public function getType(): ColumnTypeEnum
    {
        return $this->column_type;
    }

    public function name(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function default(mixed $default): static
    {
        $this->default = $default;
        return $this;
    }

    public function hasDefault(): bool
    {
        return $this->default !== null;
    }

    public function nullable(bool $nullable = true): static
    {
        $this->nullable = $nullable;
        return $this;
    }

    public function isNullable(): bool
    {
        return $this->nullable;
    }

    public function unique(bool $unique = true): static
    {
        $this->unique = $unique;
        return $this;
    }

    public function index(bool $index = true): static
    {
        $this->index = $index;
        return $this;
    }

    public function text(): string
    {
        $this->write();
        return $this->text;
    }

    protected function write(): void
    {
        $this->text = '$table->' . $this->column_type->value . "('" . $this->name . "')";

        if ($this->hasDefault()) {
            $this->text .= '->default(' . $this->getDefaultAsString() . ')';
        }

        if ($this->nullable) {
            $this->text .= '->nullable()';
        }

        if ($this->unique) {
            $this->text .= '->unique()';
        }

        if ($this->index) {
            $this->text .= '->index()';
        }

        $this->text .= ';' . PHP_EOL . chr(9) . chr(9) . chr(9);
    }

    public function getDefaultAsString()
    {
        if (is_string($this->default)) {
            if (is_numeric($this->default)) {
                return $this->default;
            }
            return "'".$this->default ."'";
        }
        return $this->default;
    }
}
