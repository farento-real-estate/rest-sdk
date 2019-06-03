<?php

namespace Farento\SDK\Components\DTO;

class Site implements DTOInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $address;

    public function __construct(array $response)
    {
        $this->id      = $response['id'];
        $this->name    = $response['name'];
        $this->address = $response['address'];
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
    public function getAddress(): string
    {
        return $this->address;
    }
}
