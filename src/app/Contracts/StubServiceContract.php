<?php

namespace Sindor\LaravelCode\App\Contracts;

interface StubServiceContract
{
    public function getStubPath(): string;

    public function getStubContent(): array;

    public function getSavePath(): string;

    public function getFileName(): string;
}
