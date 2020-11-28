<?php

namespace Ome\Event\Entities;

use Carbon\Carbon;
use DateTimeInterface;
use Ome\Event\Values\SchemeStatus;
use Ome\Exceptions\UnmatchedContextException;

class EventScheme
{
    private ?int $id;

    private string $name;

    private int $plannerId;

    private SchemeStatus $status;

    private ?DateTimeInterface $startAt;

    private ?DateTimeInterface $endAt;

    private string $explanation;

    private string $detail;

    protected function __construct(
        ?int $id,
        string $name,
        int $plannerId,
        SchemeStatus $status,
        ?DateTimeInterface $startAt,
        ?DateTimeInterface $endAt,
        string $explanation,
        string $detail
    ) {
        if (!is_null($startAt) && !is_null($endAt)) {
            if (Carbon::make($startAt)->diffInSeconds($endAt, false) < 0) {
                throw new UnmatchedContextException(self::class, 'StartAt datetime must be before EndAt datetime.');
            }
        }

        $this->id = $id;
        $this->name = $name;
        $this->plannerId = $plannerId;
        $this->status = $status;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->explanation = $explanation;
        $this->detail = $detail;
    }

    public static function createNewScheme(
        string $name,
        int $plannerId,
        ?DateTimeInterface $startAt,
        ?DateTimeInterface $endAt,
        string $explanation
    ): self {
        return new self(
            null,
            $name,
            $plannerId,
            SchemeStatus::applied(),
            $startAt,
            $endAt,
            $explanation,
            ''
        );
    }

    public static function createRegistered(
        int $id,
        string $name,
        int $plannerId,
        SchemeStatus $status,
        ?DateTimeInterface $startAt,
        ?DateTimeInterface $endAt,
        string $explanation,
        string $detail
    ): self {
        return new self(
            $id,
            $name,
            $plannerId,
            $status,
            $startAt,
            $endAt,
            $explanation,
            $detail
        );
    }

    public function editAppliedScheme(
        string $name,
        ?DateTimeInterface $startAt,
        ?DateTimeInterface $endAt,
        string $explanation
    ): self {
        if (!$this->status->equalsTo(SchemeStatus::applied())) {
            throw new UnmatchedContextException(self::class, 'Scheme has not applied status.');
        }

        if (!is_null($startAt) && !is_null($endAt)) {
            if (Carbon::make($startAt)->diffInSeconds($endAt, false) < 0) {
                throw new UnmatchedContextException(self::class, 'StartAt datetime must be before EndAt datetime.');
            }
        }

        $this->name = $name;
        $this->startAt = $startAt;
        $this->endAt = $endAt;
        $this->explanation = $explanation;

        return $this;
    }

    public function makeDetailForApproved(
        string $detail
    ): self {
        if (!$this->status->equalsTo(SchemeStatus::approved())) {
            throw new UnmatchedContextException(self::class, 'Scheme is not approved.');
        }

        $this->detail = $detail;
        return $this;
    }

    public function proceed(SchemeStatus $status): self {
        if ($status->equalsTo(SchemeStatus::approved())) {
            return $this->approve();
        }

        if ($status->equalsTo(SchemeStatus::confirmed())) {
            return $this->confirm();
        }

        if ($status->equalsTo(SchemeStatus::denied())) {
            return $this->deny();
        }
    }

    public function approve(): self
    {
        if (!$this->status->equalsTo(SchemeStatus::applied())) {
            throw new UnmatchedContextException(self::class, 'status [' . $this->status->value() . '] can not be approved.');
        }

        $this->status = SchemeStatus::applied();
        return $this;
    }

    public function deny(): self
    {
        if (!$this->status->equalsTo(SchemeStatus::applied())) {
            throw new UnmatchedContextException(self::class, 'status [' . $this->status->value() . '] can not be denied.');
        }

        $this->status = SchemeStatus::denied();
        return $this;
    }

    public function confirm(): self
    {
        if (!$this->status->equalsTo(SchemeStatus::approved())) {
            throw new UnmatchedContextException(self::class, 'status [' . $this->status->value() . '] can not be approved.');
        }

        $this->status = SchemeStatus::confirmed();
        return $this;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of plannerId
     */
    public function getPlannerId()
    {
        return $this->plannerId;
    }

    /**
     * Get the value of startAt
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Get the value of endAt
     */
    public function getEndAt()
    {
        return $this->endAt;
    }

    /**
     * Get the value of explanation
     */
    public function getExplanation()
    {
        return $this->explanation;
    }

    /**
     * Get the value of detail
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }
}
