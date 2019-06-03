<?php

namespace Farento\SDK\Components\DTO\Location;

use Farento\SDK\Components\DTO\DTOInterface;

class Street implements DTOInterface
{
    /** @var null|int */
    private $id;

    /** @var null|City */
    private $city;

    /** @var null|string */
    private $name;

    public function __construct(array $response)
    {
        $this->id   = $response['id']   ?? null;
        $this->name = $response['name'] ?? null;
        $this->city = isset($response['city']) && null !== $response['city'] ? new City($response['city']) : null;
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|City
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
