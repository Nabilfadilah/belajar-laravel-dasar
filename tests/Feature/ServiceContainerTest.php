<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    /**
     * Membuat Dependency
     *
     * @return void
     */
    public function testDependency()
    {
        // $foo = new Foo(); // gak perlu pake new 
        $foo1 = $this->app->make(Foo::class); // = new foo(), jadi pake 'make'
        $foo2 = $this->app->make(Foo::class); // = new foo(), jadi pake 'make'

        self::assertEquals('Foo', $foo1->foo());
        self::assertEquals('Foo', $foo2->foo());
        self::assertNotSame($foo1, $foo2);
    }

    public function testBind()
    {
        // ketika bikin object person, php bingung karna Person ada construct ada 2 parameter
        // $person = $this->app->make(Person::class); // new Person()

        // akan terjadi error
        // self::assertNotNull($person);

        // jadi solusinya pake 'bind(key, closure)'
        // jadi kalau ada yang membuat version, harus kasih tau laravel nya
        $this->app->bind(Person::class, function ($app) {
            // maka function ini yang akan dipanggil
            return new Person("Gobil", "Fadilah");
        });

        $person1 = $this->app->make(Person::class); // closure() jadi seakan-akan manggil // new Person("Gobil", ""Fadilah);
        $person2 = $this->app->make(Person::class); // closure()

        self::assertEquals("Gobil", $person1->firstName);
        self::assertEquals("Fadilah", $person1->lastName);
        self::assertNotSame($person1, $person2); // tidak boleh sama antara person1 dan person2
    }

    public function testSingleton()
    {
        // membuat satu object saja, bisa menggunakan singleton dan ketika butuh tinggal gunakan object yang sama
        $this->app->singleton(Person::class, function ($app) {
            return new Person("Gobil", "Fadilah");
        });

        // secara otomatis ketika menggunakan 'make' 
        // maka object hanya dibuat di awal, selanjutnya object yg sama akan digunakan terus-menerus
        // ketika memanggil make(key)
        $person1 = $this->app->make(Person::class); // closure() jadi seakan-akan manggil // new Person("Gobil", ""Fadilah);
        $person2 = $this->app->make(Person::class); // closure()

        self::assertEquals("Gobil", $person1->firstName);
        self::assertEquals("Fadilah", $person1->lastName);
        self::assertSame($person1, $person2);
    }

    public function testInstance()
    {
        // memasukan object yang sudah ada kedalam laravel nya instance
        // langsung masukan instance nya dalam $person
        $person = new Person("Gamal", "Burhan");
        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // object $person // closure() jadi seakan-akan manggil // new Person("Gobil", ""Fadilah);
        $person2 = $this->app->make(Person::class); // object $person // closure()
        $person3 = $this->app->make(Person::class); // object $person
        $person4 = $this->app->make(Person::class); // object $person

        self::assertEquals("Gamal", $person1->firstName);
        self::assertEquals("Burhan", $person1->lastName);
        self::assertSame($person, $person1);
        self::assertSame($person, $person2);
    }

    // untuk test dependency injection yang kita buat, apakah terdeteksi oleh laravel!
    public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertEquals('Foo and Bar', $bar->bar());
        self::assertSame($foo, $bar->foo);
    }

    public function testInjectionInClosure()
    {
        // Foo
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        // Bar
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class)); // ambil Foo class
        });

        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);
        self::assertSame($bar1, $bar2);
    }

    // test binding interface ke class
    public function testInterfaceToClass()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);
        self::assertEquals('Halo Bil', $helloService->hello('Bil'));
    }
}
