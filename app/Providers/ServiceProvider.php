<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider{

    public function boot(){
        $path       = base_path() . '/modules';
        $listModule = array_map('basename', File::directories($path));
        foreach ($listModule as $module){
            $module_path = $path . '/' . $module;
            $namespace   = 'Modules\\' . $module;
            Route::group(
                ['module' => $module, 'namespace' => $namespace . '\Http\Controllers'],
                function () use ($module_path){
                    $list_route = array_map('basename',
                        File::files($module_path . '/Http/Routes'));
                    dd($module_path . '/Http/Routes');
                    foreach ($list_route as $route){
                        if (file_exists($module_path . '/Http/Routes/routes.php')){
                            require $module_path . '/Http/Routes/' . $route;
                        }
                    }
                }
            );
            if (is_dir($module_path . '/Views')){
                $this->loadViewsFrom($module_path . '/Views', $module);
            }
        }
    }

    public function register(){ }
}
