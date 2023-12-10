<?php

namespace Afdn\Permission;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Afdn\Permission\PermissionMiddleware;
use Afdn\Permission\Localization;
use Afdn\Permission\AppResourceRegistrar;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('permission', PermissionMiddleware::class);
        $router->pushMiddlewareToGroup('web', Localization::class);
        $router->pushMiddlewareToGroup('web', BeforeAndAfterMiddleware::class);
        $this->publishes([
            __DIR__ . '/migrations/create_permissions_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_permissions_table.php'),
            __DIR__ . '/seeders/PermissionSeeder.php' => database_path('seeders/'.'PermissionSeeder.php'),
            __DIR__ . '/Models/Permission.php' => app_path('Models/'.'Permission.php'),
            __DIR__ . '/migrations/create_logs_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_action_logs_table.php'),
            __DIR__ . '/Models/ActionLog.php' => app_path('Models/'.'ActionLog.php'),
            __DIR__ . '/Requests/PermissionRequest.php' => app_path('Http/Requests/'.'PermissionRequest.php'),
            __DIR__ . '/Controllers/PermissionController.php' => app_path('Http/Controllers/Account/'.'PermissionController.php'),
            __DIR__ . '/routes/permission.php' => base_path('routes/'.'permission.php'),
            __DIR__ . '/public//' => public_path('vendors/'),
            __DIR__ . '/views//' => resource_path('views/'),
            __DIR__ . '/lang//' => resource_path('lang/'),
        ]);

    }

    public function register()
    {
        $registrar = new AppResourceRegistrar($this->app['router']);
        $this->app->bind('Illuminate\Routing\ResourceRegistrar', function () use ($registrar) {
            return $registrar;
        });
        require_once 'BasicPermission.php';
    }
}
