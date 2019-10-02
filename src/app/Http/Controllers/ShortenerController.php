<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Source\RouteName\ShortenerInterface as ShortenerRouteNameInterface;
use App\Services\UrlShortener;

class ShortenerController extends Controller
{
    /**
     * @var UrlShortener
     */
    private $urlShortener;

    public function __construct(UrlShortener $urlShortener)
    {
        $this->urlShortener = $urlShortener;
    }

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
            'sourceUrl' => $url,
        ];

//        $request->session()->flash('urls', $sessionFlushData);

        return redirect()
            ->route(ShortenerRouteNameInterface::SHOW_FORM)
            ->withInput($sessionFlushData);

//        return view('shortener', );
    }

    public function showStat(string $code)
    {
        return 'Stat';
    }

    public function redirect(string $code)
    {
        return 'Redirect';
    }

    private function getShortAndStatUrls(string $url): array
    {
        return $this->urlShortener->getShortAndStatUrls($url);
    }
}
