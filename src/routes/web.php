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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/shortener', 'ShortenerController@showForm')->name(ShortenerInterface::SHOW_FORM);
Route::post('/shortener', 'ShortenerController@shortUrl')->name(ShortenerInterface::SHORT_URL);

$codeChars = config('shortener.code.chars');
$ecapedCodeChars = preg_quote($codeChars);

Route::get('/shortener/{code}+', 'ShortenerController@showStat')
    ->name(ShortenerInterface::SHOW_STAT)
    ->where('code', "[{$ecapedCodeChars}]+");

Route::get('/shortener/{code}', 'ShortenerController@redirect')
    ->name(ShortenerInterface::REDIRECT)
    ->where('code', "[{$ecapedCodeChars}]+");
