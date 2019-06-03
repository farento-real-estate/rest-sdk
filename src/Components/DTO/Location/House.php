<?php

namespace Farento\SDK\Components\DTO\Location;

use Farento\SDK\Components\DTO\DTOInterface;

class House implements DTOInterface
{
    /** @var null|int */
    private $id;

    /** @var null|Street */
    private $street;

    /** @var null|District */
    private $district;

    /** @var null|string */
    private $name;

    /** @var null|string */
    private $zip;

    /** @var null|int */
    private $floorsCount;

    /** @var null|Point */
    private $location;

    public function __construct(array $response)
    {
        $this->id          = $response['id']   ?? null;
        $this->name        = $response['name'] ?? null;
        $this->street      = isset($response['street'])   && null   !== $response['street'] ? new Street($response['street']) : null;
        $this->district    = isset($response['district']) && null   !== $response['district'] ? new District($response['district']) : null;
        $this->location    = isset($response['location']) && null   !== $response['location'] ? new Point($response['location']) : null;
        $this->zip         = $response['zip']          ?? null;
        $this->floorsCount = $response['floors_count'] ?? null;
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|Street
     */
    public function getStreet(): ?Street
    {
        return $this->street;
    }

    /**
     * @return null|District
     */
    public function getDistrict(): ?District
    {
        return $this->district;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }

    /**
     * @return null|int
     */
    public function getFloorsCount(): ?int
    {
        return $this->floorsCount;
    }

    /**
     * @return null|Point
     */
    public function getLocation(): ?Point
    {
        return $this->location;
    }
}
