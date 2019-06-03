<?php

namespace Farento\SDK\Components\DTO\Location;

use Farento\SDK\Components\DTO\DTOInterface;

class Country implements DTOInterface
{
    /** @var null|int */
    private $id;

    /** @var null|string */
    private $name;

    /** @var null|int */
    private $area;

    /** @var null|City */
    private $capital;

    public function __construct(array $response)
    {
        $this->id      = $response['id']   ?? null;
        $this->name    = $response['name'] ?? null;
        $this->area    = $response['area'] ?? null;
        $this->capital = isset($response['capital']) ? new City($response['capital']) : null;
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return null|int
     */
    public function getArea(): ?int
    {
        return $this->area;
    }

    /**
     * @return null|City
     */
    public function getCapital(): ?City
    {
        return $this->capital;
    }
}
