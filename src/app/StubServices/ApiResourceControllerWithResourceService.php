<?php

namespace Sindor\LaravelCode\App\StubServices;

use Sindor\LaravelCode\App\Contracts\StubServiceContract;

class ApiResourceControllerWithResourceService extends BaseStubService implements StubServiceContract
{

    public function getStubPath(): string
    {
        return base_path('stubs/laravel-code/api-resource-controller-with-resource.stub');
    }

    public function getStubContent(): array
    {
        return $this->data;
    }

    public function getSavePath(): string
    {
       return config('laravel-code.api_controller.path');
    }

    public function getFileName(): string
    {
        return $this->data['CLASS_NAME'] . '.php';
    }

    public function init(): static
    {
        $modelName = $this->data['MODEL_NAME'];
        $this->data['NAMESPACE'] = config('laravel-code.resource_controller.namespace');
        $this->data['PARENT_CLASS'] = "\\".config('laravel-code.resource_controller.parent_class');
        $this->data['VARIABLE'] = str($modelName)->camel()->singular();
        $this->data['USES'] = "use " . config('laravel-code.model.namespace') . '\\' . $modelName . ";";
        $this->data['USES'] .= PHP_EOL . "use " . config('laravel-code.json_resource.namespace') . '\\' . $modelName . "Resource;";
        $this->data['USES'] .= PHP_EOL . "use " . config('laravel-code.json_resource.namespace') . '\\' . $modelName . "Collection;";
        $this->data['RESOURCE_NAME'] = $modelName . "Resource";
        $this->data['COLLECTION_NAME'] = $modelName . "Collection";
        return $this;
    }

    public function setFormRequest(bool $add_form_request): static
    {
        if ($add_form_request) {
            $reqName = $this->data['MODEL_NAME'] . 'FormRequest';
            $this->data['USES'] .= PHP_EOL . "use " . config('laravel-code.form_request.namespace') .'\\' . $reqName. ";";
            $this->data['REQUEST_NAME'] = $reqName;
        } else {
            $this->data['REQUEST_NAME'] = "\\" . config('laravel-code.form_request.parent_class');
        }
        return $this;
    }

    public function addRoutes(): void
    {
        $route = PHP_EOL . "Route::apiResource('"
            . $this->data['VARIABLE']
            ."', "
            . $this->data['NAMESPACE'] . "\\" . $this->data['CLASS_NAME']
            ."::class);";

        $path = base_path("routes/api.php");

        if (!file_exists($path)) {
            $content = '<?php ' . PHP_EOL . $route;
        } else{
            $content = file_get_contents($path) . $route;
        }

        file_put_contents($path, $content);
    }
}
