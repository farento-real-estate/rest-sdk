<?php

namespace Farento\SDK\Components\DTO\Contact;

use Farento\SDK\Components\DTO\DTOInterface;

class Phone implements DTOInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $phone;

    public function __construct(array $response)
    {
        $this->id    = $response['id'];
        $this->phone = $response['phone'] ?? null;
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
    public function getPhone(): string
    {
        return $this->phone;
    }
}
