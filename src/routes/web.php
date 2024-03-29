<?php

use App\Contracts\Source\RouteName\ShortenerInterface;

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

//Route::get('/', function () {
//    return view('welcome');
//});


$codeChars = config('shortener.code.chars');
$escapedCodeChars = preg_quote($codeChars);

Route::get('/{code}+', 'ShortenerController@showStat')
    ->name(ShortenerInterface::SHOW_STAT)
    ->where('code', "[{$escapedCodeChars}]+");

Route::get('/{code}', 'ShortenerController@redirect')
    ->name(ShortenerInterface::REDIRECT)
    ->where('code', "[{$escapedCodeChars}]+");

Route::get('/', 'ShortenerController@showForm')->name(ShortenerInterface::SHOW_FORM);
Route::post('/', 'ShortenerController@shortUrl')->name(ShortenerInterface::SHORT_URL);
