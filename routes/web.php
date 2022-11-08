<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
        return view('User.Dashboard');
});
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('Auth.LogIn');
    })->name('login');;
    Route::get('signup', function () {
        return view('Auth.Register');
    });
});
Route::post('/register',[\App\Http\Controllers\Authentication::class,'Register']);
Route::post('/Login',[\App\Http\Controllers\Authentication::class,'LogIn']);
Route::post('/signout',[\App\Http\Controllers\Authentication::class,'signOut'])->name('signout');
Route::middleware('auth')->group(function () {
    Route::group(['middleware' => ['IsAdmin']], function () {
        Route::get('/loadAllProjects', [\App\Http\Controllers\projects::class, 'loadAllProjects']);
        Route::get('/newProject', [\App\Http\Controllers\projects::class, 'newProjectIndex']);
        Route::post('/creat_project', [\App\Http\Controllers\projects::class, 'createNewProject']);
        Route::get('/delete_project/{id}', [\App\Http\Controllers\projects::class, 'deleteProject']);
        Route::get('/update/{id}', [\App\Http\Controllers\projects::class, 'updateProjectIndex']);
    });
});
