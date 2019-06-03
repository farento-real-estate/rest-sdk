<?php

namespace Farento\SDK\Components\DTO\Location;

use Farento\SDK\Components\DTO\DTOInterface;

class Floor implements DTOInterface
{
    /** @var null|int */
    private $id;

    /** @var null|int */
    private $number;

    /** @var null|House */
    private $house;

    public function __construct(array $response)
    {
        $this->id     = $response['id']     ?? null;
        $this->number = $response['number'] ?? null;
        $this->house  = isset($response['house']) && null !== $response['house'] ? new House($response['house']) : null;
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|int
     */
    public function getNumber(): ?int
    {
        return $this->number;
    }

    /**
     * @return null|House
     */
    public function getHouse(): ?House
    {
        return $this->house;
    }
}
