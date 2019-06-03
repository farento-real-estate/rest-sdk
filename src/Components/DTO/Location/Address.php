<?php

namespace Farento\SDK\Components\DTO\Location;

use Farento\SDK\Components\DTO\DTOInterface;

class Address implements DTOInterface
{
    /** @var null|int */
    private $id;

    /** @var null|Country */
    private $country;

    /** @var null|Region */
    private $region;

    /** @var null|City */
    private $city;

    /** @var null|District */
    private $district;

    /** @var null|Street */
    private $street;

    /** @var null|House */
    private $house;

    /** @var null|Floor */
    private $floor;

    /** @var null */
    private $flat;

    public function __construct(array $response)
    {
        $this->id       = $response['id'] ?? null;
        $this->country  = isset($response['country'])  && null     !== $response['country'] ? new Country($response['country']) : null;
        $this->region   = isset($response['region'])   && null     !== $response['region'] ? new Region($response['region']) : null;
        $this->city     = isset($response['city'])     && null     !== $response['city'] ? new City($response['city']) : null;
        $this->district = isset($response['district']) && null     !== $response['district'] ? new District($response['district']) : null;
        $this->street   = isset($response['street'])   && null     !== $response['street'] ? new Street($response['street']) : null;
        $this->house    = isset($response['house'])    && null     !== $response['house'] ? new House($response['house']) : null;
        $this->floor    = isset($response['floor'])    && null     !== $response['floor'] ? new Floor($response['floor']) : null;
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
     * @return null|Region
     */
    public function getRegion(): ?Region
    {
        return $this->region;
    }

    /**
     * @return null|City
     */
    public function getCity(): ?City
    {
        return $this->city;
    }

    /**
     * @return null|District
     */
    public function getDistrict(): ?District
    {
        return $this->district;
    }

    /**
     * @return null|Street
     */
    public function getStreet(): ?Street
    {
        return $this->street;
    }

    /**
     * @return null|House
     */
    public function getHouse(): ?House
    {
        return $this->house;
    }

    /**
     * @return null|Floor
     */
    public function getFloor(): ?Floor
    {
        return $this->floor;
    }

    public function getFlat()
    {
        return $this->flat;
    }

    public function getAddressString(): string
    {
        return $this->createAddressString();
    }

    private function createAddressString(): string
    {
        $string = '';

        $string .= $this->getCity()->getName() ? $this->getCity()->getName() : '';
        $string .= $this->getStreet()->getName() ? ', ' . $this->getStreet()->getName() : '';
        $string .= $this->getHouse()->getName() ? ', ' . $this->getHouse()->getName() : '';

        if ($this->getFloor()) {
            $string .= $this->getFloor()->getNumber() ? ', ' . $this->getFloor()->getNumber() . ' этаж' : '';
        }

        return \trim($string);
    }
}
