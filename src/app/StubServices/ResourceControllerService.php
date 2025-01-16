<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Contracts\StubServiceContract;

class ResourceControllerService extends BaseStubService implements StubServiceContract
{

    public function getStubPath(): string
    {
        return base_path('stubs/laravel-code/resource-controller.stub');
    }

    public function getStubContent(): array
    {
        return $this->data;
    }

    public function getSavePath(): string
    {
        return config('laravel-code.resource_controller.path');
    }

    public function getFileName(): string
    {
        return $this->data['CLASS_NAME'].'.php';
    }

    public function init(): static
    {
        $modelName = $this->data['MODEL_NAME'];
        $this->data['NAMESPACE'] = config('laravel-code.resource_controller.namespace');
        $this->data['PARENT_CLASS'] = "\\".config('laravel-code.resource_controller.parent_class');
        $this->data['VARIABLE_SINGULAR'] = str($modelName)->camel()->singular();
        $this->data['VARIABLE_PLURAL'] = str($modelName)->camel()->plural();
        $this->data['USES'] = "use ".config('laravel-code.model.namespace').'\\'.$modelName.";";

        // add routes
        $this->addRoutes();

        return $this;
    }

    public function setFormRequest(bool $add_form_request): static
    {
        if ($add_form_request) {
            $reqName = $this->data['MODEL_NAME'].'FormRequest';
            $this->data['USES'] .= PHP_EOL."use ".config('laravel-code.form_request.namespace').'\\'.$reqName.";";
            $this->data['REQUEST_NAME'] = $reqName;
        } else {
            $this->data['REQUEST_NAME'] = "\\".config('laravel-code.form_request.parent_class');
        }
        return $this;
    }

    private function addRoutes(): void
    {
        if (\Route::has($this->data['VARIABLE_SINGULAR'].".index")) {
            return;
        }

        $route = PHP_EOL."Route::resource('"
            .$this->data['VARIABLE_SINGULAR']
            ."', "
            .$this->data['NAMESPACE']."\\".$this->data['CLASS_NAME']
            ."::class);";

        $path = base_path("routes/web.php");

        if (!file_exists($path)) {
            $content = '<?php '.PHP_EOL.$route;
        } else {
            $content = file_get_contents($path).$route;
        }

        file_put_contents($path, $content);
    }
}
