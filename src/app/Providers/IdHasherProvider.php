<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\IdHasher;

class IdHasherProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $hashChars = config('shortener.code.chars');

        $idHasherBuilder = $this->app->when(IdHasher::class);
        $idHasherBuilder
            ->needs('$hashChars')
            ->give($hashChars);

        $minLength = config('shortener.code.min_length');
        $idHasherBuilder
            ->needs('$minLength')
            ->give($minLength);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
