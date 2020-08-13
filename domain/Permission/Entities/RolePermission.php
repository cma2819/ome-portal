<?php

namespace Ome\Permission\Entities;

use Ome\Exceptions\UnmatchedContextException;
use Ome\Permission\Values\Domain;

class RolePermission
{
    private string $id;

    /** @var Domain[] */
    private array $allowed;

    protected function __construct(
        string $id,
        array $allowed
    ) {
        foreach ($allowed as $domain) {
            if (!($domain instanceof Domain)) {
                throw new UnmatchedContextException(self::class, 'allowed domain name is not matched.');
            }
        }
        $this->id = $id;
        $this->allowed = $allowed;
    }

    /**
     * @param string $id
     * @param Domain[] $allowed
     * @return self
     */
    public static function create(
        string $id,
        array $allowed
    ): self {
        return new self($id, $allowed);
    }

    public function allow(Domain $domain): self
    {
        if (!in_array($domain, $this->allowed)) {
            $this->allowed[] = $domain;
        }
        return $this;
    }

    public function ban(Domain $domain): self
    {
        foreach ($this->allowed as $index => $allowed) {
            if ($allowed->equalsTo($domain)) {
                unset($this->allowed[$index]);
            }
        }
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
     * Get the value of allowed
     */
    public function getAllowed()
    {
        return $this->allowed;
    }
}
