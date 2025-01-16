<?php

namespace Sindor\LaravelCode\App\DTOs;

use Illuminate\Http\Request;

class FormDTO
{
    public function __construct(
        public string $table_name,
        public bool $add_migration,
        public bool $add_model,
        public bool $add_form_request,
        public bool $add_resource_controller,
        public bool $add_dto,
        public bool $add_json_resource,
        public bool $add_api_controller,
        public bool $add_observer,
        public bool $add_factory,

        public array $columns = [],
    )
    {
    }

    public static function fromRequest(Request $request): FormDTO
    {
        return new self(
            table_name: $request->input('table_name'),
            add_migration: self::getBool($request->input('add_migration')),
            add_model: self::getBool($request->input('add_model')),
            add_form_request: self::getBool($request->input('add_form_request')),
            add_resource_controller: self::getBool($request->input('add_resource_controller')),
            add_dto: self::getBool($request->input('add_dto')),
            add_json_resource: self::getBool($request->input('add_json_resource')),
            add_api_controller: self::getBool($request->input('add_api_controller')),
            add_observer: self::getBool($request->input('add_observer')),
            add_factory: self::getBool($request->input('add_factory')),
            columns: $request->input('columns') ?? [],
        );
    }

    public function getModelName(): string
    {
        return str($this->table_name)->singular()->studly();
    }

    private static function getBool(mixed $val): bool
    {
        if (is_null($val)) {
            return false;
        }

        return $val == 'on';
    }
}
