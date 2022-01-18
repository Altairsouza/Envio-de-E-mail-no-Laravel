<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Main;

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
    // apresentar o formulário de criação de mensagem
Route::get('/', [Main::class,'index'])->name('main_index');
Route::post('/init', [Main::class,'init'])->name('main_init');


    // confirmação do envio de mensagem
Route::get('/confirm/{purl}',[Main::class,'confirm'])->name('main_confirm');


// leitura da mesangem
Route::get('/read/{purl}', [Main::class, 'read'])->name('main_read');
