<?php

namespace Farento\SDK\Components\DTO\Location;

use Farento\SDK\Components\DTO\DTOInterface;

class Point implements DTOInterface
{
    /** @var null|float */
    private $latitude;

    /** @var null|float */
    private $longitude;

    public function __construct(array $response)
    {
        $this->latitude  = $response['latitude']  ?? null;
        $this->longitude = $response['longitude'] ?? null;
    }

    /**
     * @return null|float
     */
    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    /**
     * @return null|float
     */
    public function getLongitude(): ?float
    {
        return $this->longitude;
    }
}
