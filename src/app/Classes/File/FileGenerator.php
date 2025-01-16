<?php

namespace Sindor\LaravelCode\App\Classes\File;

use Illuminate\Support\Facades\File;
use Sindor\LaravelCode\App\Contracts\StubServiceContract;

class FileGenerator
{
    public function __construct(
        protected StubServiceContract $service
    )
    {
    }

    public static function make(StubServiceContract $service): static
    {
        return new static($service);
    }

    public function generate(): void
    {
        $content = file_get_contents($this->service->getStubPath());

        foreach ($this->service->getStubContent() as $key => $value) {
            $content = str_replace('$'.$key.'$', $value, $content);
        }

        $file_path = $this->service->getSavePath() . DIRECTORY_SEPARATOR . $this->service->getFileName();

        if (!File::exists($this->service->getSavePath())) {
            File::makeDirectory($this->service->getSavePath());
        }

        if (File::exists($file_path)) {
            return;
//            throw new \Exception("File already exists at path: {$file_path}",0);
        }

        File::put($file_path, $content);
    }

}
