<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ClientDetailController;
use App\Http\Controllers\Auth\CustomAuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');

//ver clientes
Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

// clientes
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
Route::put('/clients/{client}/update-status', [ClientController::class, 'updateStatus'])->name('clients.updateStatus');
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');

// servicos
Route::get('clients/{client}', [ClientDetailController::class, 'show'])->name('clients.show');
Route::post('clients/{client}/add-service', [ClientDetailController::class, 'addService'])->name('clients.addService');
Route::delete('clients/{client}/remove-service/{service}', [ClientDetailController::class, 'removeService'])->name('clients.removeService');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::get('services/{service}', [ServiceController::class, 'show'])->name('services.show');

//exportacoes para excel
Route::get('/export', [ServiceController::class, 'exportServices'])->name('services.export');
Route::get('/export', [ClientController::class, 'exportClients'])->name('clients.export');


// rotas todos
Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
Route::get('/todos/create', [TodoController::class, 'create'])->name('todos.create');
Route::post('/todos/store', [TodoController::class, 'store'])->name('todos.store');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');



Route::get('/login', [CustomAuthController::class, 'showLoginForm'])->name('login');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
