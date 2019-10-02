<?php

namespace App\Http\Controllers;

use App\Contracts\Source\RouteName\ShortenerInterface as ShortenerRouteNameInterface;
use App\Repositories\UrlRepository;
use App\Services\RequestToVisitorDataConverter;
use App\Services\UrlShortener;
use App\Url as UrlModel;
use Illuminate\Http\Request;

class ShortenerController extends Controller
{
    /**
     * @var UrlShortener
     */
    private $urlShortener;

    /**
     * @var UrlRepository
     */
    private $urlRepository;

    /**
     * @var RequestToVisitorDataConverter
     */
    private $requestToVisitorDataConverter;

    public function __construct(
        UrlShortener $urlShortener,
        UrlRepository $urlRepository,
        RequestToVisitorDataConverter $requestToVisitorDataConverter
    )
    {
        $this->urlShortener = $urlShortener;
        $this->urlRepository = $urlRepository;
        $this->requestToVisitorDataConverter = $requestToVisitorDataConverter;
    }

    public function showForm()
    {
        $sessionFlushData = session()->getOldInput();

        return view('shortener', $sessionFlushData);
    }

    public function shortUrl(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $url = $request->get('url');//todo sanitize url

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

    private function getShortAndStatUrls(string $url): array
    {
        return $this->urlShortener->getShortAndStatUrls($url);
    }

    public function showStat(string $code)
    {
        return 'Stat';
    }

    public function redirect(string $code, Request $request)
    {
        $urlModel = $this->getUrlModelByCode($code);

        $this->addVisitorByRequest($urlModel, $request);

        return $this->redirectByUrlModel($urlModel);
    }

    private function getUrlModelByCode(string $code)
    {
        return $this->urlRepository->getByCode($code);
    }

    private function addVisitorByRequest(UrlModel $urlModel, Request $request)
    {
        $visitorData = $this->getVisitorDataByRequest($request);

        $urlModel->visitors()->create($visitorData);
    }

    private function getVisitorDataByRequest(Request $request): array
    {
        return $this->requestToVisitorDataConverter->convert($request);
    }

    private function redirectByUrlModel(UrlModel $urlModel)
    {
        $redirectUrl = $urlModel->url;

        return redirect($redirectUrl);//todo: status code?
    }
}
