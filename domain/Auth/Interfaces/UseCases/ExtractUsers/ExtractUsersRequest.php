<?php

namespace Ome\Auth\Interfaces\UseCases\ExtractUsers;

use Ome\Exceptions\InvalidRequestException;

/**
 * Request object for ExtractUsers.
 */
class ExtractUsersRequest
{
    private int $page;

    public function __construct(
        int $page
    ) {
        if ($page < 0) {
            throw new InvalidRequestException(['page' => $page]);
        }

        $this->page = $page;
    }

    /**
     * Get the value of page
     */
    public function getPage()
    {
        return $this->page;
    }
}
