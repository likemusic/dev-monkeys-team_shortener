<?php

namespace App\Services;

use App\Contracts\Source\RouteName\ShortenerInterface;

class UrlGenerator
{
    public function getShortUrl(string $code): string
    {
        return route(ShortenerInterface::REDIRECT, ['code' => $code]);
    }

    public function getStatUrl(string $code): string
    {
        return route(ShortenerInterface::SHOW_STAT, ['code' => $code]);
    }
}
