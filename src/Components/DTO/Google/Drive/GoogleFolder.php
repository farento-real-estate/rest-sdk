<?php

namespace Farento\SDK\Components\DTO\Google\Drive;

use Farento\SDK\Components\DTO\DTOInterface;

class GoogleFolder implements DTOInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $parentId;

    /** @var string */
    private $folderId;

    public function __construct(array $response)
    {
        $this->id       = $response['id'];
        $this->name     = $response['name'];
        $this->parentId = $response['parent_id'];
        $this->folderId = $response['folder_id'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getParentId(): string
    {
        return $this->parentId;
    }

    /**
     * @return string
     */
    public function getFolderId(): string
    {
        return $this->folderId;
    }
}
