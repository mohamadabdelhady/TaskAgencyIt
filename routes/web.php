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
        Route::get('/Create_task/{id}', [\App\Http\Controllers\tasks::class, 'createTaskIndex']);
        Route::post('/createTask', [\App\Http\Controllers\tasks::class, 'createTask']);
        Route::get('/createTask', [\App\Http\Controllers\tasks::class, 'createTask']);
        Route::get('/Assign_task/{id}', [\App\Http\Controllers\tasks::class, 'assignTaskIndex']);
        Route::get('/getTasks', [\App\Http\Controllers\tasks::class, 'loadAllTasks']);
        Route::get('/getAllEmployees', [\App\Http\Controllers\tasks::class, 'getAllEmployees']);
        Route::post('/SaveAssignment', [\App\Http\Controllers\tasks::class, 'SaveAssignment']);
        Route::get('/DeleteAssignment/{id}/{employee}', [\App\Http\Controllers\tasks::class, 'DeleteAssignment']);
        Route::get('/deleteTask/{id}', [\App\Http\Controllers\tasks::class, 'deleteTask']);
        Route::post('/updateProject/{id}', [\App\Http\Controllers\projects::class, 'updateProject']);
        Route::get('/updateTask/{id}', [\App\Http\Controllers\tasks::class, 'updateTaskIndex']);
        Route::post('/updateTask/{id}', [\App\Http\Controllers\tasks::class, 'updateTask']);
        Route::get('/getProjectAssignedEmployees/{id}', [\App\Http\Controllers\projects::class, 'getProjectAssignedEmployees']);
        Route::get('/getTasksAssignedEmployees/{id}', [\App\Http\Controllers\tasks::class, 'getTasksAssignedEmployees']);
        Route::get('/getReport/{id}', [\App\Http\Controllers\tasks::class, 'getReport']);
    });
    Route::get('/getMyTasks', [\App\Http\Controllers\tasks::class, 'getMyTasks']);
    Route::get('/getMyProjects', [\App\Http\Controllers\projects::class, 'getMyProjects']);
    Route::post('/submitTask', [\App\Http\Controllers\tasks::class, 'submitTask']);
});
