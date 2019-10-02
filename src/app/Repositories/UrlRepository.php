<?php

namespace App\Repositories;

use App\Services\IdHasher;
use App\Url as UrlModel;

class UrlRepository
{
    /**
     * @var UrlModel
     */
    private $urlModel;

    /**
     * @var IdHasher
     */
    private $idHasher;

    public function __construct(UrlModel $urlModel, IdHasher $idHasher)
    {
        $this->urlModel = $urlModel;
        $this->idHasher = $idHasher;
    }

    public function getOrAddByUrl(string $url): ?UrlModel
    {
        $urlModel = $this->getByUrl($url);

        if ($urlModel) {
            return $urlModel;
        }

        return $this->addByUrl($url);
    }

    private function getByUrl(string $url): ?UrlModel
    {
        return $this->urlModel->where('url', $url)->first();
    }

    private function addByUrl(string $url): ?UrlModel
    {
        $model = $this->addByData(['url' => $url]);
        $this->updateCodeById($model);

        return $this->save($model);
    }

    private function addByData(array $data)
    {
        return $this->urlModel->create($data);
    }

    private function updateCodeById(UrlModel $urlModel)
    {
        $id = $urlModel->id;
        $code = $this->getCodeById($id);
        $urlModel->code = $code;
    }

    private function getCodeById(int $id)
    {
        return $this->idHasher->getHash($id);
    }

    private function save(UrlModel $model)
    {
        $model->save();
    }

    public function getByCode(string $code): ?UrlModel
    {
        return $this->urlModel->where('code', $code)->first();
    }
}
