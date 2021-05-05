<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    public function boot()
    {
        $path = base_path() . '/modules';
        $listModule = array_map('basename', File::directories($path));
        foreach ($listModule as $module) {
            $module_path = $path . '/' . $module;
            $namespace = 'Modules\\' . $module;

            Route::group(
                ['module' => $module, 'namespace' => $namespace . '\Http\Controllers'],
                function () use ($module_path, $module) {
                    /** Route admin */
                    $route_path_admin = $module_path . '/Http/Routes/admin.php';
                    if ($module !== 'Auth') {
                        Route::middleware(['admin'])
                            ->prefix('admin')
                            ->group(function () use ($route_path_admin) {
                                if (file_exists($route_path_admin)) {
                                    require $route_path_admin;
                                }
                            });
                    } else {
                        if (file_exists($route_path_admin)) {
                            require $route_path_admin;
                        }
                    }

                    /** Route web */
                    $route_path_web = $module_path . '/Http/Routes/web.php';
                    if (file_exists($route_path_web)) {
                        require $route_path_web;
                    }
                }
            );
            if (is_dir($module_path . '/Langs')) {
                //Multiple language php file
                $this->loadTranslationsFrom($module_path . "/Langs", $module);
                //Multiple language file json
                $this->loadJSONTranslationsFrom($module_path . '/Langs');
            }

            if (is_dir($module_path . '/Views')) {
                $this->loadViewsFrom($module_path . '/Views', $module);
            }
        }
    }

    public function register()
    {

    }
}
