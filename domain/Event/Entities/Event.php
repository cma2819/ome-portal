<?php

namespace Ome\Event\Entities;

use DateTimeInterface;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;
use Ome\Exceptions\UnmatchedContextException;

class Event
{
    private OengusMarathon $oengusMarathon;

    private RelateType $relateType;

    private Slug $slug;

    protected function __construct(
        OengusMarathon $oengusMarathon,
        RelateType $relateType,
        Slug $slug
    ) {
        $this->oengusMarathon = $oengusMarathon;
        $this->relateType = $relateType;
        $this->slug = $slug;
    }

    public static function createWithMarathon(
        OengusMarathon $oengusMarathon,
        RelateType $relateType,
        Slug $slug
    ): self {
        return new self(
            $oengusMarathon,
            $relateType,
            $slug
        );
    }

    public function getId(): string
    {
        return $this->oengusMarathon->getId();
    }

    /**
     * Get the value of relateType
     */
    public function getRelateType()
    {
        return $this->relateType;
    }

    /**
     * Get the value of slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the value of relateType
     *
     * @return  self
     */
    public function setRelateType($relateType)
    {
        $this->relateType = $relateType;

        return $this;
    }

    /**
     * Set the value of slug
     *
     * @return  self
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get the value of oengusMarathon
     */
    public function getOengusMarathon()
    {
        return $this->oengusMarathon;
    }

    /**
     * Set the value of oengusMarathon
     *
     * @return  self
     */
    public function setOengusMarathon($oengusMarathon)
    {
        if ($this->oengusMarathon->getId() !== $oengusMarathon->getId()) {
            throw new UnmatchedContextException(OengusMarathon::class, 'Overwrite OengusMarathon must have same ID.');
        }
        $this->oengusMarathon = $oengusMarathon;

        return $this;
    }
}
