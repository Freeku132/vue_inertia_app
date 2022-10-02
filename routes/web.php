<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
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
Route::middleware('auth')->group(function () {
    Route::get('/default', function () {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    });

    Route::get('/', function () {
        return Inertia::render('Home', [
            'frameworks' =>
                [
                    'Laravel', 'Vue', 'Inertia'
                ],
            'time' => now()->toTimeString()
        ]);
    });

    Route::get('/users', [UserController::class, 'index']);

    Route::get('/users/create', [UserController::class, 'create'])
        ->can('create', User::class);
//        ->middleware('can:create, App\Models\User');

    Route::post('/users', [UserController::class, 'store']);

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');

    Route::post('users/{user}/update',[UserController::class, 'update'])->can('update', User::class );


    Route::get('/settings', function () {
        sleep(2);
        return Inertia::render('Settings');
    });


    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
});
require __DIR__.'/auth.php';
