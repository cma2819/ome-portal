<?php

namespace Tests\Unit\Domain\Notification;

use Ome\Auth\Entities\PartialDiscordUser;
use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Values\SchemeStatus;
use Ome\Notification\Commands\InmemorySendNotification;
use Ome\Notification\Entities\EventSchemeNotification;
use Ome\Notification\Interfaces\UseCases\SendApplySchemeNotification\SendApplySchemeNotificationRequest;
use Ome\Notification\UseCases\SendApplySchemeNotificationInteractor;
use PHPUnit\Framework\TestCase;

class SendApplySchemeNotificationInteractorTest extends TestCase
{
    /** @test */
    public function testSendApplySchemeNotification()
    {
        $scheme = EventScheme::createRegistered(
            1,
            '応募イベント',
            1,
            SchemeStatus::approved(),
            null,
            null,
            '応募したイベントです',
            ''
        );
        $profile = new UserProfile(
            1,
            'username',
            PartialDiscordUser::createPartial(
                'user',
                'username',
                '1234'
            )
        );

        $sendNotification = new InmemorySendNotification;

        $interactor = new SendApplySchemeNotificationInteractor($sendNotification);

        $result = $interactor->interact(
            new SendApplySchemeNotificationRequest($scheme, $profile)
        )->getNotification();

        $expect = EventSchemeNotification::createFromScheme($scheme, $profile);
        $this->assertEquals($expect, $result);
        $this->assertContainsEquals($expect, $sendNotification->getNotifications());
    }

}
