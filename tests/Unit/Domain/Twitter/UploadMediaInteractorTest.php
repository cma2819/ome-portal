<?php

namespace Tests\Unit\Domain\Twitter;

use GuzzleHttp\Psr7\UploadedFile;
use Ome\Twitter\Interfaces\Repositories\TwitterMediaRepository;
use Ome\Twitter\Repositories\InmemoryTwitterMediaRepository;
use Ome\Twitter\UseCases\UploadMediaInteractor;
use Ome\Twitter\Values\TwitterMediaType;
use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit\Framework\TestCase;

class UploadMediaInteractorTest extends TestCase
{
    protected vfsStreamDirectory $root;

    protected TwitterMediaRepository $twitterMediaRepository;

    protected function setUp(): void
    {
        $this->root = vfsStream::setUp('root');
        $this->twitterMediaRepository = new InmemoryTwitterMediaRepository();
    }

    /** @test */
    public function testUploadMedia()
    {
        $file = vfsStream::newFile('test.jpeg')->at($this->root)->setContent(LargeFileContent::withMegabytes(1));
        $result = (new UploadMediaInteractor($this->twitterMediaRepository))->interact(
            new UploadedFile($file->url(), $file->size(), UPLOAD_ERR_OK, $file->getName(), 'image/jpeg')
        );

        $this->assertEquals(1, $result->getId());
        $this->assertEquals(TwitterMediaType::photo(), $result->getType());
    }

}
