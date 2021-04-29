<?php

namespace Tests\Feature\Streams;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Ome\Permission\Interfaces\Queries\GetRolesForUserQuery;
use Tests\TestCase;

class StreamInternalTest extends TestCase
{

    use AuthStreamInternalUser;
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpStreamInternalUser();
    }

    /** @test */
    public function testStreamInternal()
    {
        $response = $this->actingAs($this->streamInternalUser())->get(route('streams.internal', ['id' => 'test']));

        $response->assertSuccessful();
    }

    /** @test */
    public function testStreamNotInGuildUser()
    {
        $this->app->bind(GetRolesForUserQuery::class, function (Application $app) {
            return new GetEmptyRolesForUserQuery;
        });

        $response = $this->actingAs($this->streamInternalUser())->get(route('streams.internal', ['id' => 'test']));

        $response->assertForbidden();
    }

}
