<?php

namespace Ome\Twitter\Repositories;

use Ome\Twitter\Entities\PartialTwitterMedia;
use Ome\Twitter\Entities\TwitterMedia;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Values\TwitterMediaType;
use Psr\Http\Message\UploadedFileInterface;
use RuntimeException;

class InmemoryTwitterMediaRepository implements TwitterMediaRepository
{
    /** @var TwitterMedia[] */
    protected array $medias = [];

    /**
     * @param TwitterMedia[] $medias
     */
    public function __construct(
        array $medias = []
    )
    {
        $this->medias = $medias;
    }

    public function find(int $id): ?TwitterMedia
    {
        foreach ($this->medias as $media) {
            if ($media->getId() === $id) {
                return $media;
            }
        }

        return null;
    }

    public function save(UploadedFileInterface $file): TwitterMedia
    {
        switch ($file->getClientMediaType()) {
            case 'image/jpeg':
            case 'image/png':
            case 'image/gif':
                $type = TwitterMediaType::photo();
                break;
            case 'video/mp4':
                $type = TwitterMediaType::video();
            default:
                throw new RuntimeException('Media type ' . $file->getClientMediaType() . ' is not allowed.');
        }
        $media = PartialTwitterMedia::createPartial(
            $this->nextId(),
            $file->getStream()->getMetadata()['uri'],
            $type
        );
        $this->medias[$media->getId()] = $media;
        return $media;
    }

    protected function nextId(): int
    {
        return (array_key_last($this->medias) ?? 0) + 1;
    }
}
