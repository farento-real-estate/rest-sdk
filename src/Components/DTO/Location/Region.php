<?php

namespace Farento\SDK\Components\DTO\Location;

use Farento\SDK\Components\DTO\DTOInterface;

class Region implements DTOInterface
{
    /** @var null|int */
    private $id;

    /** @var null|Country */
    private $country;

    /** @var null|string */
    private $name;

    /** @var null|string */
    private $cad;

    /** @var null|string */
    private $code;

    /** @var null|City */
    private $capital;

    public function __construct(array $response)
    {
        $this->id      = $response['id']   ?? null;
        $this->name    = $response['name'] ?? null;
        $this->cad     = $response['cad']  ?? null;
        $this->code    = $response['code'] ?? null;
        $this->country = isset($response['country']) && null !== $response['country'] ? new Country($response['country']) : null;
        $this->capital = isset($response['capital']) && null !== $response['capital'] ? new City($response['capital']) : null;
    }

    /**
     * @return null|int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return null|Country
     */
    public function getCountry(): ?Country
    {
        return $this->country;
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
    public function getCad(): ?string
    {
        return $this->cad;
    }

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @return null|City
     */
    public function getCapital(): ?City
    {
        return $this->capital;
    }
}
