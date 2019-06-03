<?php

namespace Farento\SDK\Components\DTO\Location;

use Farento\SDK\Components\DTO\DTOInterface;

class City implements DTOInterface
{
    /** @var null|int */
    private $id;

    /** @var null|Region */
    private $region;

    /** @var null|string */
    private $cad;

    /** @var null|string */
    private $name;

    /** @var null|int */
    private $population;

    /** @var null|Point */
    private $center;

    public function __construct(array $response)
    {
        $this->id         = $response['id'] ?? null;
        $this->region     = isset($response['region']) && null !== $response['region'] ? new Region($response['region']) : null;
        $this->cad        = $response['cad']        ?? null;
        $this->name       = $response['name']       ?? null;
        $this->population = $response['population'] ?? null;
        $this->center     = isset($response['center']) && null !== $response['center'] ? new Point($response['center']) : null;
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|Region
     */
    public function getRegion(): ?Region
    {
        return $this->region;
    }

    /**
     * @return null|string
     */
    public function getCad(): ?string
    {
        return $this->cad;
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
    public function getPopulation(): ?int
    {
        return $this->population;
    }

    /**
     * @return null|Point
     */
    public function getCenter(): ?Point
    {
        return $this->center;
    }
}
