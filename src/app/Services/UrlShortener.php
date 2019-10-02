<?php

namespace App\Services;

use App\Repositories\UrlRepository;

class UrlShortener
{
    /**
     * @var UrlRepository
     */
    private $urlRepository;

    /**
     * @var IdHasher
     */
    private $idHasher;

    /**
     * @var UrlGenerator
     */
    private $urlGenerator;

    public function __construct(
        UrlRepository $urlRepository,
        IdHasher $idHasher,
        UrlGenerator $urlGenerator
    )
    {
        $this->urlRepository = $urlRepository;
        $this->idHasher = $idHasher;
        $this->urlGenerator = $urlGenerator;
    }

    public function getShortAndStatUrls(string $url)
    {
        $urlCode = $this->getCodeByUrl($url);
        $shortUrl = $this->generateShortUrl($urlCode);
        $statUrl = $this->generateStatUrl($urlCode);

        return [
            $shortUrl,
            $statUrl,
        ];
    }

    private function getCodeByUrl(string $url)
    {
        $urlModel = $this->getOrCreateAndSaveUrlModel($url);

        return $urlModel->code;
    }

    private function getOrCreateAndSaveUrlModel(string $url)
    {
        return $this->urlRepository->getOrAddByUrl($url);
    }

    private function generateShortUrl(string $code): string
    {
        return $this->urlGenerator->getShortUrl($code);
    }

    private function generateStatUrl(string $code): string
    {
        return $this->urlGenerator->getStatUrl($code);
    }
}
