<?php

namespace App\Providers;

use App\Http\Interfaces\Rate\IRateCheck;
use App\Http\Interfaces\Rate\IRateFind;
use App\Http\Interfaces\Rate\IRateStore;
use App\Http\Interfaces\User\IUserActive;
use App\Http\Interfaces\User\IUserDelete;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Interfaces\User\IUserLogin;
use App\Http\Interfaces\User\IUserLogout;
use App\Http\Interfaces\User\IUserRegister;
use App\Http\Interfaces\User\IUserStore;
use App\Http\Interfaces\User\IUserUpdate;
use App\Http\Interfaces\User\IUserUpdateService;
use App\Http\Interfaces\UserPermission\IUserPermissionService;
use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Repositories\Rate\RateFindRepo;
use App\Repositories\Rate\RateStoreRepo;
use App\Repositories\User\UserDeleteRepo;
use App\Repositories\User\UserFindRepo;
use App\Repositories\User\UserStoreRepo;
use App\Repositories\User\UserUpdateRepo;
use App\Repositories\UserPermission\UserPermissionStoreRepo;
use App\Services\Rate\RateService;
use App\Services\User\UserActiveService;
use App\Services\User\UserLoginService;
use App\Services\User\UserLogoutService;
use App\Services\User\UserRegisterService;
use App\Services\User\UserUpdateService;
use App\Services\UserPermission\UserPermissionService;
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
        $this->setRate();
        $this->setUser();
        $this->setUserPermission();
    }

    private function setUserPermission() {
        $this->app->bind(IUserPermissionStore::class, UserPermissionStoreRepo::class);
        $this->app->bind(IUserPermissionService::class, UserPermissionService::class);
    }
    private function setUser(){
        $this->app->bind(IUserStore::class, UserStoreRepo::class);
        $this->app->bind(IUserRegister::class, UserRegisterService::class);
        $this->app->bind(IUserLogin::class, UserLoginService::class);
        $this->app->bind(IUserFind::class, UserFindRepo::class);
        $this->app->bind(IUserLogout::class, UserLogoutService::class);
        $this->app->bind(IUserUpdate::class, UserUpdateRepo::class);
        $this->app->bind(IUserUpdateService::class, UserUpdateService::class);
        $this->app->bind(IUserActive::class, UserActiveService::class);
        $this->app->bind(IUserDelete::class, UserDeleteRepo::class);
    }

    private function setRate(){
        $this->app->bind(IRateStore::class, RateStoreRepo::class);
        $this->app->bind(IRateFind::class, RateFindRepo::class);
        $this->app->bind(IRateCheck::class, RateService::class);
    }
}
