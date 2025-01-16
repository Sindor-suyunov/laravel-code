<?php

namespace Sindor\LaravelCode\App\Classes;

use Sindor\LaravelCode\App\Classes\Database\Table;
use Sindor\LaravelCode\App\Classes\File\FileGenerator;
use Sindor\LaravelCode\App\DTOs\FormDTO;
use Sindor\LaravelCode\App\StubServices\{ApiResourceControllerWithoutResourceService,
    ApiResourceControllerWithResourceService,
    DTOService,
    FactoryService,
    FormRequestService,
    JsonResourceService,
    MigrationService,
    ModelService,
    ObserverService,
    ResourceCollectionService,
    ResourceControllerService};

class MainExecutor
{
    public function __construct(
        public FormDTO $data,
        public Table $table,
    ) {
    }

    public static function make(FormDTO $data): MainExecutor
    {
        return new self(
            $data,
            Table::fromDTO($data)
        );
    }

    /**
     * @throws \Exception
     */
    public function execute(): void
    {
        if ($this->data->add_migration) {
            $this->generateMigration();
        }

        if ($this->data->add_model) {
            $this->generateModel();
        }

        if ($this->data->add_form_request) {
            $this->generateRequest();
        }

        if ($this->data->add_resource_controller) {
            $this->generateResourceController();
        }

        if ($this->data->add_dto) {
            $this->generateDTO();
        }

        if ($this->data->add_json_resource) {
            $this->generateJsonResource();
        }

        if ($this->data->add_api_controller) {
            $this->generateApiController();
        }

        if ($this->data->add_observer) {
            $this->generateObserver();
        }

        if ($this->data->add_factory) {
            $this->generateFactory();
        }
    }

    /**
     * @throws \Exception
     */
    private function generateMigration(): void
    {
        FileGenerator::make(
            MigrationService::make([
                'TABLE_NAME' => $this->table->getName(),
                'COLUMNS' => $this->table->text(),
            ])
        )->generate();
    }

    /**
     * @throws \Exception
     */
    private function generateModel(): void
    {
        FileGenerator::make(
            ModelService::make([
                'CLASS_NAME' => $this->data->getModelName(),
            ])
                ->setColumns($this->table->getColumns())
                ->init()
        )->generate();
    }

    /**
     * @throws \Exception
     */
    private function generateRequest(): void
    {
        FileGenerator::make(
            FormRequestService::make([
                'CLASS_NAME' => $this->data->getModelName().'FormRequest',
            ])
                ->setColumns($this->table->getColumns())
                ->init()
        )->generate();
    }


    /**
     * @throws \Exception
     */
    private function generateResourceController(): void
    {
        FileGenerator::make(
            ResourceControllerService::make([
                'CLASS_NAME' => $this->data->getModelName().'ResourceController',
                'MODEL_NAME' => $this->data->getModelName()
            ])
                ->init()
                ->setFormRequest($this->data->add_form_request)
        )->generate();
    }

    /**
     * @throws \Exception
     */
    private function generateDTO(): void
    {
        FileGenerator::make(
            DTOService::make([
                'CLASS_NAME' => $this->data->getModelName().'DTO',
            ])
                ->setColumns($this->table->getColumns())
                ->init()
        )->generate();
    }

    private function generateJsonResource(): void
    {
        FileGenerator::make(
            JsonResourceService::make([
                'CLASS_NAME' => $this->data->getModelName().'Resource',
            ])
                ->setColumns($this->table->getColumns())
                ->init()
        )->generate();

        FileGenerator::make(
            ResourceCollectionService::make([
                'CLASS_NAME' => $this->data->getModelName().'Collection',
                'MODEL_NAME' => $this->data->getModelName(),
            ])
                ->init()
        )->generate();
    }

    private function generateApiController(): void
    {
        $data = [
            'CLASS_NAME' => $this->data->getModelName().'APIController',
            'MODEL_NAME' => $this->data->getModelName()
        ];
        $service = ApiResourceControllerWithoutResourceService::make($data)->init()
            ->setFormRequest($this->data->add_form_request);
        if ($this->data->add_json_resource) {
            $service = ApiResourceControllerWithResourceService::make($data)->init()
                ->setFormRequest($this->data->add_form_request);
        }

        FileGenerator::make(
            $service
        )->generate();

        $service->addRoutes();
    }

    private function generateObserver(): void
    {
        FileGenerator::make(
            ObserverService::make([
                'CLASS_NAME' => $this->data->getModelName().'Observer',
                'MODEL_NAME' => $this->data->getModelName()
            ])
                ->init()
        )->generate();
    }

    private function generateFactory(): void
    {
        FileGenerator::make(
            FactoryService::make([
                'CLASS_NAME' => $this->data->getModelName().'Factory',
                'MODEL_NAME' => $this->data->getModelName()
            ])
                ->setColumns($this->table->getColumns())
                ->init()
        )->generate();
    }
}
