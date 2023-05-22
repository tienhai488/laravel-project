<?php

namespace modules;

use Modules\User\Src\Http\Middlewares\DemoMiddleware;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Modules\User\src\Commands\TienHaiCommand;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        if (!empty($directories)) {
            foreach ($directories as $moduleName) {
                $this->registerModule($moduleName);
            }
        }
    }

    public function registerModule($moduleName)
    {
        $modulePath = __DIR__ . "/$moduleName/";

        //Khai bao route
        $this->loadRoute($modulePath);

        // Khai báo migration
        // Toàn bộ file migration của modules sẽ tự động được load
        $this->loadMigration($modulePath);

        
        // Khai báo helpers
        $this->loadHelpers($modulePath);

        // Khai báo languages
        $this->loadLanguages($moduleName);

        // Khai báo views
        // Gọi view thì ta sử dụng: view('Demo::index'), @extends('Demo::index'), @include('Demo::index')
        $this->loadViews($moduleName);

    }

    private function loadRoute($modulePath){
        if (File::exists($modulePath . "routes/routes.php")) {
            $this->loadRoutesFrom($modulePath . "routes/routes.php");
        }
    }

    private function loadMigration($modulePath){
        if (File::exists($modulePath . "migrations")) {
            $this->loadMigrationsFrom($modulePath . "migrations");
        }
    }

    private function loadViews($moduleName){
        $modulePath = __DIR__ . "/$moduleName/";
        if (File::exists($modulePath . "resources/views")) {
            $this->loadViewsFrom($modulePath . "resources/views", strtolower($moduleName));
        }
    }

    private function loadLanguages($moduleName){
        $modulePath = __DIR__ . "/$moduleName/";
        if (File::exists($modulePath . "resources/lang")) {
            // Đa ngôn ngữ theo file php
            // Dùng đa ngôn ngữ tại file php resources/lang/en/general.php : @lang('Demo::general.hello')
            $this->loadTranslationsFrom($modulePath . "resources/lang", strtolower($moduleName));
            // Đa ngôn ngữ theo file json
            $this->loadJSONTranslationsFrom($modulePath . 'resources/lang');
        }
    }

    private function loadHelpers($modulePath){
        if (File::exists($modulePath . "helpers")) {
            // Tất cả files có tại thư mục helpers
            $helper_dir = File::allFiles($modulePath . "helpers");
            // khai báo helpers
            foreach ($helper_dir as $key => $value) {
                $file = $value->getPathName();
                require $file;
            }
        }
    }


    public function register()
    {
        // Khai báo configs
        $directories = array_map('basename', File::directories(__DIR__));

        if (!empty($directories)) {
            foreach ($directories as $moduleName) {
                $configPath = __DIR__ . "/$moduleName/configs";
                if (File::exists($configPath)) {
                    $configFiles = array_map('basename', File::allFiles($configPath));
                    foreach ($configFiles as $key => $value) {
                        $alias = basename($value, '.php');
                        $this->mergeConfigFrom($configPath . '/' . $value, $alias);
                    }
                }
            }
        }

        // Khai báo middleare
        $middleare = [
            'tienhai' => DemoMiddleware::class,
        ];
        foreach ($middleare as $key => $value) {
            $this->app['router']->pushMiddlewareToGroup($key, $value);
        }

        // Khai báo commands
        $this->commands([
            TienHaiCommand::class
        ]);
    }
}