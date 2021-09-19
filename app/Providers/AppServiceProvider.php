<?php

namespace App\Providers;

use App\Http\Interfaces\Rate\IRateCheck;
use App\Http\Interfaces\Rate\IRateFindRepo;
use App\Http\Interfaces\Rate\IRateStore;
use App\Http\Interfaces\User\IUserActive;
use App\Http\Interfaces\User\IUserFindRepo;
use App\Http\Interfaces\User\IUserLogin;
use App\Http\Interfaces\User\IUserLogout;
use App\Http\Interfaces\User\IUserRegister;
use App\Http\Interfaces\User\IUserUpdate;
use App\Http\Interfaces\UserAddress\IUserAddressDelete;
use App\Http\Interfaces\UserAddress\IUserAddressFindRepo;
use App\Http\Interfaces\UserAddress\IUserAddressStore;
use App\Http\Interfaces\UserAddress\IUserAddressUpdate;
use App\Http\Interfaces\UserContact\IUserContactDelete;
use App\Http\Interfaces\UserContact\IUserContactFindRepo;
use App\Http\Interfaces\UserContact\IUserContactStore;
use App\Http\Interfaces\UserContact\IUserContactUpdate;
use App\Http\Interfaces\UserPermission\IUserPermissionDelete;
use App\Http\Interfaces\UserPermission\IUserPermissionStore;
use App\Repositories\Rate\RateFindRepo;
use App\Repositories\User\UserFindRepo;
use App\Repositories\UserAddress\UserAddressFindRepo;
use App\Repositories\UserContact\UserContactFind;
use App\Services\Rate\RateService;
use App\Services\User\UserService;
use App\Services\UserAddress\UserAddressService;
use App\Services\UserContact\UserContactService;
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
        $this->setUserContact();
    }

    private function setUserContact(){
        $this->app->bind(IUserContactFindRepo::class, UserContactFind::class);
        $this->app->bind(IUserContactStore::class, UserContactService::class);
        $this->app->bind(IUserContactUpdate::class, UserContactService::class);
        $this->app->bind(IUserContactDelete::class, UserContactService::class);
    }

    private function setUserAddress(){
        $this->app->bind(IUserAddressFindRepo::class, UserAddressFindRepo::class);
        $this->app->bind(IUserAddressStore::class, UserAddressService::class);
        $this->app->bind(IUserAddressUpdate::class, UserAddressService::class);
        $this->app->bind(IUserAddressDelete::class, UserAddressService::class);
    }

    private function setUserPermission() {
        $this->app->bind(IUserPermissionStore::class, UserPermissionService::class);
        $this->app->bind(IUserPermissionDelete::class, UserPermissionService::class);
    }

    private function setUser(){
        $this->app->bind(IUserFindRepo::class, UserFindRepo::class);
        $this->app->bind(IUserRegister::class, UserService::class);
        $this->app->bind(IUserLogin::class, UserService::class);
        $this->app->bind(IUserLogout::class, UserService::class);
        $this->app->bind(IUserUpdate::class, UserService::class);
        $this->app->bind(IUserActive::class, UserService::class);
    }

    private function setRate(){
        $this->app->bind(IRateFindRepo::class, RateFindRepo::class);
        $this->app->bind(IRateStore::class, RateService::class);
        $this->app->bind(IRateCheck::class, RateService::class);
    }
}
