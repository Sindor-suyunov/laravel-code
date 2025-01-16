<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Contracts\StubServiceContract;

class MigrationService extends BaseStubService implements StubServiceContract
{

    public function getStubPath(): string
    {
        return base_path("stubs/laravel-code/migration.stub");
    }

    public function getStubContent(): array
    {
        return $this->data;
    }

    public function getSavePath(): string
    {
        return config('laravel-code.migration.path');
    }

    public function getFileName(): string
    {
        return date('Y_m_d_His') . '_create_' . $this->data['TABLE_NAME'] . '_table.php';
    }
}
