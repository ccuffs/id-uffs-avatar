<?php

use App\Http\Controllers\Avatar;
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

// Fix wrong style/mix urls when being served from reverse proxy
$proxy_url    = env('PROXY_URL');
$proxy_schema = env('PROXY_SCHEME');

if (!empty($proxy_url)) {
   URL::forceRootUrl($proxy_url);
}

if (!empty($proxy_schema)) {
   URL::forceScheme($proxy_schema);
}

Route::get('/iduffs/{uid}', [Avatar::class, 'index'])->name('use.iduffs');

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
