<?php

namespace Ome\Event\UseCases;

use Ome\Event\Entities\AdminStatusReply;
use Ome\Event\Interfaces\Commands\PersistAdminReplyCommand;
use Ome\Event\Interfaces\Commands\PersistEventSchemeCommand;
use Ome\Event\Interfaces\Queries\FindEventSchemeQuery;
use Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusRequest;
use Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusResponse;
use Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusUseCase;
use Ome\Event\Values\SchemeStatus;
use Ome\Exceptions\EntityNotFoundException;
use Ome\Exceptions\UnmatchedContextException;

class ProceedEventSchemeStatusInteractor implements ProceedEventSchemeStatusUseCase
{
    protected PersistEventSchemeCommand $persistEventScheme;

    protected FindEventSchemeQuery $findEventScheme;

    protected PersistAdminReplyCommand $persistAdminReply;

    public function __construct(
        PersistEventSchemeCommand $persistEventScheme,
        FindEventSchemeQuery $findEventScheme,
        PersistAdminReplyCommand $persistAdminReply
    ) {
        $this->persistEventScheme = $persistEventScheme;
        $this->findEventScheme = $findEventScheme;
        $this->persistAdminReply = $persistAdminReply;
    }

    public function interact(ProceedEventSchemeStatusRequest $request): ProceedEventSchemeStatusResponse
    {
        $eventScheme = $this->findEventScheme->fetch($request->getId());

        if (is_null($eventScheme)) {
            throw new EntityNotFoundException(self::class, ['id' => $request->getId()]);
        }
        $status = SchemeStatus::createFromValue($request->getStatus());
        $eventScheme->proceed($status);

        switch ($request->getStatus()) {
            case SchemeStatus::approved()->value():
                $reply = AdminStatusReply::createApproveReply(
                    $eventScheme->getId(),
                    $request->getProceedReply(),
                    $request->getNow()
                );
                break;
            case SchemeStatus::confirmed()->value():
                $reply = AdminStatusReply::createConfirmReply(
                    $eventScheme->getId(),
                    $request->getProceedReply(),
                    $request->getNow()
                );
                break;
            case SchemeStatus::denied()->value():
                $reply = AdminStatusReply::createDenyReply(
                    $eventScheme->getId(),
                    $request->getProceedReply(),
                    $request->getNow()
                );
                break;
            default:
                throw new UnmatchedContextException(SchemeStatus::class, 'Received unmatched scheme status: ' . $request->getStatus() . '.');
        }

        return new ProceedEventSchemeStatusResponse(
            $this->persistEventScheme->execute($eventScheme),
            $this->persistAdminReply->execute($reply)
        );
    }
}
