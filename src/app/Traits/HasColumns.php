<?php

namespace Sindor\LaravelCode\App\Traits;

trait HasColumns
{
    public array $columns = [];

    public function setColumns(array $columns): static
    {
        $this->columns = $columns;
        return $this;
    }
}
