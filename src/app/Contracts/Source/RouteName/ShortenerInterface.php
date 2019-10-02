<?php

namespace App\Contracts\Source\RouteName;

interface ShortenerInterface
{
    const SHOW_FORM = 'shortener.show_form';
    const SHORT_URL = 'shortener.short_url';
    const REDIRECT = 'shortener.redirect';
    const SHOW_STAT = 'shortener.show_stat';
}
