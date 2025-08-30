<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    // redirect kemana?
    public function redirectTo(): string
    {
        return "Redirect To";
    }

    // redirect dari?
    public function redirectFrom(): RedirectResponse
    {
        return redirect('/redirect/to');
    }

    // redirect to named routes
    public function redirectName(): RedirectResponse
    {
        // tanpa memasukan path
        return redirect()->route('redirect-hello', ['name' => 'Abil']); // pake paramter Abil
    }

    public function redirectHello(string $name): string
    {
        return "Hello $name";
    }

    // redirect to controller action
    public function redirectAction(): RedirectResponse
    {
        // nanti otomatis akan masuk ke redirectHello, yang otomatis tau masuk ke redirect mana!
        return redirect()->action([RedirectController::class, 'redirectHello'], ['name' => 'Abil']); // pake paramter Abil
    }

    // redirect to external domain
    public function redirectAway(): RedirectResponse
    {
        // nanti otomatis akan masuk ke redirectHello, yang otomatis tau masuk ke redirect mana!
        return redirect()->away("https://portofolio-nabil.vercel.app/"); // langsung tambah domain lain
    }
}
