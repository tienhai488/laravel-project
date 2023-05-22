<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CreateModule extends Command
{
    protected $signature = 'make:module {name}';

    protected $description = 'Create Module';

    public function handle()
    {
        $name = $this->argument('name');
        $path = base_path("modules/$name");
        if(File::exists($path)){
            $this->error("Module $name exists!");
        }else{
            File::makeDirectory($path,0755,true,true);

            $pathConfigs = $path.'/configs';
            File::makeDirectory($pathConfigs,0755,true,true);

            $pathHelpers = $path.'/helpers';
            File::makeDirectory($pathHelpers,0755,true,true);

            $pathMigrations = $path.'/migrations';
            File::makeDirectory($pathMigrations,0755,true,true);

            $pathResources = $path.'/resources';
            $pathResourcesLang = $pathResources.'/lang';
            $pathResourcesViews = $pathResources.'/views';
            File::makeDirectory($pathResources,0755,true,true);
            File::makeDirectory($pathResourcesLang,0755,true,true);
            File::makeDirectory($pathResourcesViews,0755,true,true);

            $pathRoutes = $path.'/routes';
            $pathRoutesFile = $pathRoutes.'/routes.php';
            File::makeDirectory($pathRoutes,0755,true,true);
            File::put($pathRoutesFile,"<?php \nuse Illuminate\Support\Facades\Route;");

            $pathSrc = $path.'/src';

            $pathCommands = $pathSrc.'/Commands';

            $pathHttp = $pathSrc.'/Http';
            $pathControllers = $pathHttp.'/Controllers';
            $pathMiddlewares = $pathHttp.'/Middlewares';
            
            $pathModels = $pathSrc.'/Models';

            File::makeDirectory($pathSrc,0755,true,true);
            File::makeDirectory($pathCommands,0755,true,true);
            File::makeDirectory($pathHttp,0755,true,true);
            File::makeDirectory($pathControllers,0755,true,true);
            File::makeDirectory($pathMiddlewares,0755,true,true);
            File::makeDirectory($pathModels,0755,true,true);

            $pathRepositories = $pathSrc.'/Repositories';
            File::makeDirectory($pathRepositories,0755,true,true);

            $pathRepository = $pathRepositories.'/'.$name."Repository.php";
            $pathRepositoryContent = file_get_contents(base_path('app/Console/Commands/Template/Repository.txt'));
            $pathRepositoryContent = str_replace('{model}',$name,$pathRepositoryContent);

            $pathRepositoryInterface = $pathRepositories.'/'.$name."RepositoryInterface.php";
            $pathRepositoryInterfaceContent = file_get_contents(base_path('app/Console/Commands/Template/RepositoryInterface.txt'));
            $pathRepositoryInterfaceContent = str_replace('{model}',$name,$pathRepositoryInterfaceContent);

            File::put($pathRepository,$pathRepositoryContent);
            File::put($pathRepositoryInterface,$pathRepositoryInterfaceContent);

            $this->info("Create Module $name Success");
        }
    }
}