<?php

namespace Ome\Event\Entities;

use Ome\Event\Values\PlanStatus;
use Ome\Exceptions\Validations\LengthValidationException;

class EventPlan
{

    private const NAME_MAX_LENGTH = 255;

    private ?int $id;

    private string $name;

    private int $plannerId;

    private PlanStatus $status;

    private string $explanation;

    protected function __construct(
        ?int $id,
        string $name,
        int $plannerId,
        PlanStatus $status,
        string $explanation
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->plannerId = $plannerId;
        $this->status = $status;
        $this->explanation = $explanation;
    }

    public static function createNewPlan(
        string $name,
        int $plannerId,
        string $explanation
    ): self {

        if (strlen($name) > self::NAME_MAX_LENGTH) {
            throw new LengthValidationException('name', '<', self::NAME_MAX_LENGTH);
        }
        return new self(
            null,
            $name,
            $plannerId,
            PlanStatus::default(),
            $explanation
        );
    }

    public static function createRegisteredPlan(
        int $id,
        string $name,
        int $plannerId,
        PlanStatus $status,
        string $explanation
    ): self {
        return new self(
            $id,
            $name,
            $plannerId,
            $status,
            $explanation
        );
    }

    public function edit(
        string $name,
        string $explanation
    ): self {

        if ($name > self::NAME_MAX_LENGTH) {
            throw new LengthValidationException('name', '<', self::NAME_MAX_LENGTH);
        }

        $this->name = $name;
        $this->explanation = $explanation;

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
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of explanation
     */
    public function getExplanation()
    {
        return $this->explanation;
    }
}
