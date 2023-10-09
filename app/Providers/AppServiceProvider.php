<?php

namespace App\Providers;

use App\Helpers\CmsSidebar;
use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('admin.inc.left_sidebar', function () {
            $this->generateCmsSidebar();
            view()->share('sidebarItems', CmsSidebar::getInstance()->getItems());
        });
        if (Schema::hasTable('users')) {
            view()->share('users', User::all());
        }
        if (Schema::hasTable('tasks')) {
            view()->share('tasks', Task::all());
        }
        if (Schema::hasTable('departments')) {
            view()->share('departaments', Department::all());
        }
        if (Schema::hasTable('notifications')) {
            view()->share('notifications', (new NotificationService)->getAlert());
        }
    }

    public function generateCmsSidebar()
    {
        $adminSidebarMenu = CmsSidebar::getInstance();
        $adminSidebarMenu->addItems(config('cms_sidebar_menu'));
    }
}
