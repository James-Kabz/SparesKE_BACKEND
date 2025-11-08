<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class ModulesServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $modulesPath = app_path('Modules');

        foreach (File::directories($modulesPath) as $module) {
            $routesPath = $module . '/routes/api.php';

            if (File::exists($routesPath)) {
                Route::prefix('api')
                    ->middleware('api')
                    ->group($routesPath);
            }
        }
    }
}
