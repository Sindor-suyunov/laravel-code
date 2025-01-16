<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Sindor\LaravelCode\App\Classes\MainExecutor;
use Sindor\LaravelCode\App\DTOs\FormDTO;

Route::middleware('web')->group(function () {
    Route::post('/laravel-code', function (Request $request) {
        try {
            MainExecutor::make(FormDTO::fromRequest($request))->execute();
            $request->session()->put('generated', 'success');
            return redirect('/laravel-code');
        } catch (Throwable $throwable) {
            if (app()->environment('local')) {
                dd($throwable);
            }
            $request->session()->put('generated', 'error');
            return redirect('/laravel-code');
        }
    })->name('laravel-code.generate');

    Route::view('/laravel-code', 'laravel-code::new-table');
});
