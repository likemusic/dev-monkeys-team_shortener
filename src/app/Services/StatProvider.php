<?php

namespace App\Services;

use App\Repositories\UrlRepository;
use App\Services\UrlGenerator;

class StatProvider
{
    /**
     * @var UrlRepository
     */
    private $urlRepository;

    /**
     * @var UrlGenerator
     */
    private $urlGenerator;

    public function __construct(UrlRepository $urlRepository, UrlGenerator $urlGenerator)
    {
        $this->urlRepository = $urlRepository;
        $this->urlGenerator = $urlGenerator;
    }

    public function getStatByCode(string $code): array
    {
        $urlModel = $this->getUrlModelByCode($code);

        $total = $urlModel->visitors()->count();
        $visitors  = $urlModel->visitors;

        $shortUrl = $this->getShortUrlByCode($code);
        $sourceUrl = $urlModel->url;

        return [
            'urls' => [
                'source' => $sourceUrl,
                'short' => $shortUrl,
            ],
            'total' => $total,
            'visitors' => $visitors,
        ];
    }

    private function getShortUrlByCode(string $code)
    {
        return $this->urlGenerator->getShortUrl($code);
    }

    private function getUrlModelByCode(string $code)
    {
        return $this->urlRepository->getByCode($code);
    }
}
