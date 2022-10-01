<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/123', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/', function (){
    return Inertia::render('Home', [
        'frameworks' =>
            [
            'Laravel', 'Vue', 'Inertia'
        ],
        'time' => now()->toTimeString()
    ]);
});
Route::get('/users', function (){

    return Inertia::render('Users', [
        'users' => \App\Models\User::query()
            ->when(Request::input('search'), function ($query, $search ) {
                $query->where('name', 'like', '%'.$search.'%');
    })
            ->paginate(10)
            ->withQueryString()
            ->through(fn($user) =>
        [
            'id' => $user->id,
            'name' => $user->name,
        ]),
        'filters' => Request::only(['search'])
    ]);
});
Route::get('/settings', function (){
    sleep(2);
    return Inertia::render('Settings');
});
Route::post('/eloelo', function (){
    dd(request('foo'));
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
