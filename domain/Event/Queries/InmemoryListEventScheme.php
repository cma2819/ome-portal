<?php

namespace Ome\Event\Queries;

use Carbon\Carbon;
use DateTimeInterface;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\Queries\ListEventSchemeQuery;
use Ome\Event\Values\SchemeStatus;

class InmemoryListEventScheme implements ListEventSchemeQuery
{
    /** @var EventScheme[] */
    private array $schemes;

    public function __construct(
        array $schemes = []
    ) {
        $this->schemes = $schemes;
    }

    public function fetch(?int $plannerId, ?array $status, ?DateTimeInterface $startAt, ?DateTimeInterface $endAt): array
    {
        $result = [];

        foreach ($this->schemes as $scheme) {
            if (!is_null($plannerId)) {
                if ($scheme->getPlannerId() !== $plannerId) {
                    continue;
                }
            }

            if (is_array($status) && !$this->_statusIsIn($scheme, $status)) {
                continue;
            }

            if (!is_null($startAt)) {
                if (!(Carbon::make($startAt)->isBefore($scheme->getStartAt()))) {
                    continue;
                }
            }

            if (!is_null($endAt)) {
                if (!(Carbon::make($endAt)->isAfter($scheme->getEndAt()))) {
                    continue;
                }
            }

            $result[] = $scheme;
        }

        return $result;
    }

    private function _statusIsIn(
        EventScheme $scheme,
        array $status
    ): bool {

        /** @var SchemeStatus */
        foreach ($status as $st) {
            if ($scheme->getStatus()->equalsTo($st)) {
                return true;
            }
        }

        return false;
    }
}
