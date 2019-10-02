<?php

namespace App\Services;

use App\Url;

class UrlShortener
{
    /**
     * @var Url
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
        Url $urlRepository,
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
        $urlModelId = $urlModel->id;

        return $this->getCodeById($urlModelId);
    }

    private function getOrCreateAndSaveUrlModel(string $url)
    {
        $urlModel = $this->getUrlModelByUrl($url);

        if ($urlModel) {
            return $urlModel;
        }

        return $this->createAndSaveUrlModel($url);
    }

    private function getUrlModelByUrl(string $url)
    {
        return $this->urlRepository->where('url', $url)->first();
    }

    private function createAndSaveUrlModel(string $url)
    {
        return $this->urlRepository->create(['url' => $url]);
    }

    private function getCodeById(int $urlModelId)
    {
        return $this->idHasher->getHash($urlModelId);
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
