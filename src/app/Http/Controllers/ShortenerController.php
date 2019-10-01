<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Source\RouteName\ShortenerInterface as ShortenerRouteNameInterface;

class ShortenerController extends Controller
{
    public function showForm()
    {
        $sessionFlushData = session()->getOldInput();

        return view('shortener', $sessionFlushData);
    }

    public function shortUrl(Request $request)
    {
        $url = $request->get('url');

        [$shortUrl, $statUrl] = $this->getShortAndStatUrls($url);

        $sessionFlushData = [
            'shortUrl' => $shortUrl,
            'statUrl' => $statUrl,
            'url' => $url,
        ];

//        $request->session()->flash('urls', $sessionFlushData);

        return redirect()
            ->route(ShortenerRouteNameInterface::SHOW_FORM)
            ->withInput($sessionFlushData);

//        return view('shortener', );
    }

    private function getShortAndStatUrls(string $url): array
    {
        return [
            'https://bit.ly/2odofR4',
            'https://bit.ly/2odofR4+'
        ];
    }
}
