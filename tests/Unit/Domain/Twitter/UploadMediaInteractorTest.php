<?php

namespace Tests\Unit\Domain\Twitter;

use GuzzleHttp\Psr7\UploadedFile;
use Ome\Twitter\Commands\InmemoryPersistTwitterMedia;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Interfaces\UseCases\UploadMedia\UploadMediaRequest;
use Ome\Twitter\UseCases\UploadMediaInteractor;
use Ome\Twitter\Values\TwitterMediaType;
use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class UploadMediaInteractorTest extends TestCase
{

    protected vfsStreamDirectory $root;

    protected function setUp(): void
    {
        $this->root = vfsStream::setUp('root');
    }

    /** @test */
    public function testUploadMedia()
    {
        $file = vfsStream::newFile('test.jpeg')->at($this->root)->setContent(LargeFileContent::withMegabytes(1));
        $response = (new UploadMediaInteractor(
            new InmemoryPersistTwitterMedia
        ))->interact(
            new UploadMediaRequest($file->url(), 'image/jpeg')
        );

        $this->assertEquals(1, $response->getUploadedMedia()->getId());
    }
}
