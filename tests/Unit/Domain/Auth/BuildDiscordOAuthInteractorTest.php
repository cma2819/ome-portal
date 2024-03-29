<?php

namespace Tests\Unit\Domain\Auth;

use AuthDiscord\AuthDiscord;
use Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth\BuildDiscordOAuthRequest;
use Ome\Auth\UseCases\BuildDiscordOAuthInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\OAuth\MockStateGenerator;

class BuildDiscordOAuthInteractorTest extends TestCase
{
    /** @test */
    public function testBuildOAuthData()
    {
        $mockStateGenerator = new MockStateGenerator('random value');
        $authDiscord = new AuthDiscord(
            '123456789',
            'client_secret',
        );

        $result = (new BuildDiscordOAuthInteractor(
            $mockStateGenerator,
            $authDiscord
        ))->interact(
            new BuildDiscordOAuthRequest(
                '123456789',
                'https://example.com',
                ['identify']
            )
        );

        $this->assertEquals($mockStateGenerator->getMock(), $result->getState());
        $this->assertEquals(
            'https://discord.com/api/oauth2/authorize?response_type=code&client_id=123456789&scope=identify&state=random+value&redirect_url=https%3A%2F%2Fexample.com&prompt=consent',
            $result->getOauthUrl()
        );
    }

}
