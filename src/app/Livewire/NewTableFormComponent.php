<?php

namespace Sindor\LaravelCode\App\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Livewire\Component;

class NewTableFormComponent extends Component
{
    public array $columns = [];

    public function addColumn(): void
    {
        $this->columns[] = [
            'name' => '',
            'type' => 'string',
            'default' => '',
            'nullable' => false,
            'unique' => false,
            'index' => false,
        ];
    }

    public function render(): Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|View|Application
    {
        return view('laravel-code::livewire.new-table-form-component');
    }
}
