<?php

namespace App\Providers;

use App\Http\Interfaces\Rate\IRateCheck;
use App\Http\Interfaces\Rate\IRateFind;
use App\Http\Interfaces\Rate\IRateStore;
use App\Http\Interfaces\User\IUserActive;
use App\Http\Interfaces\User\IUserFind;
use App\Http\Interfaces\User\IUserLogin;
use App\Http\Interfaces\User\IUserLogout;
use App\Http\Interfaces\User\IUserRegister;
use App\Http\Interfaces\User\IUserUpdate;
use App\Http\Interfaces\UserAddress\IUserAddressDelete;
use App\Http\Interfaces\UserAddress\IUserAddressFind;
use App\Http\Interfaces\UserAddress\IUserAddressStore;
use App\Http\Interfaces\UserAddress\IUserAddressUpdate;
use App\Http\Interfaces\UserPermission\IUserPermissionDelete;
use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Repositories\Rate\RateFindRepo;
use App\Repositories\User\UserFindRepo;
use App\Repositories\UserAddress\UserAddressFindRepo;
use App\Services\Rate\RateService;
use App\Services\User\UserService;
use App\Services\UserAddress\UserAddressService;
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

        //BIND ABSTRACT AND CONCRETE
        $this->setRate();
        $this->setUser();
        $this->setUserPermission();
        $this->setUserAddress();
    }
    private function setUserAddress(){
        $this->app->bind(IUserAddressFind::class, UserAddressFindRepo::class);
        $this->app->bind(IUserAddressStore::class, UserAddressService::class);
        $this->app->bind(IUserAddressUpdate::class, UserAddressService::class);
        $this->app->bind(IUserAddressDelete::class, UserAddressService::class);
    }

    private function setUserPermission() {
        $this->app->bind(IUserPermissionStore::class, UserPermissionService::class);
        $this->app->bind(IUserPermissionDelete::class, UserPermissionService::class);
    }
    private function setUser(){
        $this->app->bind(IUserFind::class, UserFindRepo::class);
        $this->app->bind(IUserRegister::class, UserService::class);
        $this->app->bind(IUserLogin::class, UserService::class);
        $this->app->bind(IUserLogout::class, UserService::class);
        $this->app->bind(IUserUpdate::class, UserService::class);
        $this->app->bind(IUserActive::class, UserService::class);
    }

    private function setRate(){
        $this->app->bind(IRateFind::class, RateFindRepo::class);
        $this->app->bind(IRateStore::class, RateService::class);
        $this->app->bind(IRateCheck::class, RateService::class);
    }
}
