<?php

namespace Sindor\LaravelCode\App\StubServices;

abstract class BaseStubService
{
    public array $data = [];

    public static function make(array $data = []): static
    {
        $service = new static();
        $service->data = $data;

        return $service;
    }
}
