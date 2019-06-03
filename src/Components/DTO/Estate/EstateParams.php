<?php

namespace Farento\SDK\Components\DTO\Estate;

use Farento\SDK\Components\DTO\SimpleDTOInterface;

class EstateParams implements SimpleDTOInterface
{
    /** @var string */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
