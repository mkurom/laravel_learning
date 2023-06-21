<?php

use Illuminate\Support\Facades\Route;


// 
use App\Http\Controllers\TodoController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// トップ画面
Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
// 詳細
Route::get('/todos/{id}',  [TodoController::class, 'show'])->name('todos.show');
// 更新
Route::put('/todos/{id}',  [TodoController::class, 'update'])->name('todos.update');

// 新規作成
Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
