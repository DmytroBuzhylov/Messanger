<?php

use App\Http\Middleware\MainMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([MainMiddleware::class])->group(function () {

   Route::get('/main', 'App\Http\Controllers\Main\IndexController')->name('main');
   Route::get('/main/{friendId}', 'App\Http\Controllers\Main\MessageController')->name('messages');
   Route::post('/main/create', 'App\Http\Controllers\Main\CreateController')->name('messages.create');
   Route::put('/main/update/{id}', 'App\Http\Controllers\Main\UpdateController')->name('message.update');
   Route::delete('/main/create/{id}', 'App\Http\Controllers\Main\DeleteController')->name('message.delete');
   Route::get('/profile', 'App\Http\Controllers\Profile\IndexController')->name('profile');
   Route::post('/profile', 'App\Http\Controllers\Contact\CreateController')->name('add_contact');
   Route::patch('/profile', 'App\Http\Controllers\Contact\UpdateController')->name('update_contact');
   Route::delete('/profile', 'App\Http\Controllers\Contact\DeleteController')->name('delete_contact');



});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
