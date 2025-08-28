<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    // binding & singletons properties
    public array $singletons = [
        HelloService::class => HelloServiceIndonesia::class
    ];

    /**
     * Register services. kita harus registrasi dependensi yang dibutuhkan ke service container
     *
     * @return void
     */
    public function register()
    {
        // test
        echo "FooBarServiceProvider";


        $this->app->singleton(Foo::class, function () {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services. bisa melakukan hal apapun yang diperlukan setelah proses registrasi depedensi selesai
     *
     * @return void
     */
    public function boot() {}

    // ngasih tahu bahwa depedensinya ini aja!
    public function provides()
    {
        // kasih tahu untuk Foo dan Bar
        return [HelloService::class, Foo::class, Bar::class];
    }
}
