<?php

namespace Tests\Unit\Domain\Stream;

use Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth\BuildTwitchOAuthRequest;
use Ome\Stream\UseCases\BuildTwitchOAuthInteractor;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\OAuth\MockStateGenerator;

class BuildTwitchOAuthInteractorTest extends TestCase
{
    /** @test */
    public function testBuildTwitchOAuth()
    {
        $stateGenerator = new MockStateGenerator('c3ab8aa609ea11e793ae92361f002671');

        $interactor = new BuildTwitchOAuthInteractor(
            $stateGenerator
        );

        $result = $interactor->interact(
            new BuildTwitchOAuthRequest(
                'uo6dggojyb8d6soh92zknwmi5ej1q2',
                'http://localhost',
                ['viewing_activity_read']
            )
        );

        $this->assertEquals(
            $result->getOauthUrl(),
            'https://id.twitch.tv/oauth2/authorize'
            . '?client_id=' . urlencode('uo6dggojyb8d6soh92zknwmi5ej1q2')
            . '&redirect_uri=' . urlencode('http://localhost')
            . '&response_type=' . urlencode('code')
            . '&scope=' . urlencode('viewing_activity_read')
            . '&force_verify=' . urlencode('true')
            . '&state=' . urlencode('c3ab8aa609ea11e793ae92361f002671')
        );
        $this->assertEquals(
            $result->getState(),
            'c3ab8aa609ea11e793ae92361f002671'
        );
    }

}
