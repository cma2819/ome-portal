<?php

namespace Ome\Twitter\Interfaces\Dto;

class UploadedMediaDto
{
    private string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}
