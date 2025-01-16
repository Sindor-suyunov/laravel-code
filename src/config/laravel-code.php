<?php

return [
    'migration' => [
        'path' => database_path('migrations'),
    ],
    'model' => [
        'parent_class' => \Illuminate\Database\Eloquent\Model::class,
        'namespace' => 'App\Models',
        'add_fillable' => true,
        'add_casts' => true,
        'path' => app_path('Models'),
    ],
    'form_request' => [
        'parent_class' => \Illuminate\Foundation\Http\FormRequest::class,
        'namespace' => 'App\Http\Requests',
        'path' => app_path('Http/Requests')
    ],
    'resource_controller' => [
        'parent_class' => \App\Http\Controllers\Controller::class,
        'namespace' => 'App\Http\Controllers',
        'path' => app_path('Http/Controllers')
    ],
    'api_controller' => [
        'parent_class' => \App\Http\Controllers\Controller::class,
        'namespace' => 'App\Http\Controllers',
        'path' => app_path('Http/Controllers')
    ],
    'dto' => [
        'namespace' => 'App\DTOs',
        'path' => app_path('DTOs')
    ],
    'json_resource' => [
        'namespace' => 'App\Http\Resources',
        'path' => app_path('Http/Resources')
    ],
    'observer' => [
        'namespace' => 'App\Observers',
        'path' => app_path('Observers')
    ],
    'factory' => [
        'namespace' => 'Database\Factories',
        'path' => database_path('factories')
    ]
];
