<?php

namespace App\Providers;

use App\Http\Interfaces\Rate\IRateCheck;
use App\Http\Interfaces\Rate\IRateFind;
use App\Http\Interfaces\Rate\IRateStore;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Interfaces\User\IUserLogin;
use App\Http\Interfaces\User\IUserLogout;
use App\Http\Interfaces\User\IUserRegister;
use App\Http\Interfaces\User\IUserStore;
use App\Http\Interfaces\User\IUserUpdate;
use App\Http\Interfaces\User\IUserUpdateService;
use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Repositories\Rate\RateFind;
use App\Repositories\Rate\RateStore;
use App\Repositories\User\UserFind;
use App\Repositories\User\UserStore;
use App\Repositories\User\UserUpdate;
use App\Repositories\UserPermission\UserPermissionStore;
use App\Services\Rate\RateService;
use App\Services\User\UserLoginService;
use App\Services\User\UserLogoutService;
use App\Services\User\UserRegisterService;
use App\Services\User\UserUpdateService;
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
        $this->app->bind(IUserPermissionStore::class, UserPermissionStore::class);
    }
    private function setUser(){
        $this->app->bind(IUserStore::class, UserStore::class);
        $this->app->bind(IUserRegister::class, UserRegisterService::class);
        $this->app->bind(IUserLogin::class, UserLoginService::class);
        $this->app->bind(IUserFind::class, UserFind::class);
        $this->app->bind(IUserLogout::class, UserLogoutService::class);
        $this->app->bind(IUserUpdate::class, UserUpdate::class);
        $this->app->bind(IUserUpdateService::class, UserUpdateService::class);
    }

    private function setRate(){
        $this->app->bind(IRateStore::class, RateStore::class);
        $this->app->bind(IRateFind::class, RateFind::class);
        $this->app->bind(IRateCheck::class, RateService::class);
    }
}
