<?php

namespace Farento\SDK\Components\DTO\Advert;

use Farento\SDK\Components\DTO\Contact\Contact;
use Farento\SDK\Components\DTO\DTOInterface;
use Farento\SDK\Components\DTO\Location\Address;

class Advert implements DTOInterface
{
    public const STATUS_PENDING = '0';

    public const STATUS_SUCCESS = '1';

    /** @var int */
    private $id;

    /** @var string */
    private $status;

    /** @var string */
    private $type;

    /** @var string */
    private $category;

    /** @var int */
    private $price;

    /** @var int */
    private $rooms;

    /** @var float */
    private $area;

    /** @var string */
    private $description;

    /** @var Address */
    private $address;

    /** @var null|Contact */
    private $contact;

    public function __construct(array $response)
    {
        $this->id          = $response['id'];
        $this->status      = (string) $response['status'];
        $this->type        = $response['type'];
        $this->category    = $response['category'];
        $this->price       = $response['price'];
        $this->rooms       = $response['rooms'];
        $this->area        = $response['area'];
        $this->description = $response['description'];
        $this->address     = new Address($response['address']);
        $this->contact     = isset($response['contact']) ? new Contact($response['contact']) : null;
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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function getRooms(): int
    {
        return $this->rooms;
    }

    /**
     * @return null|float
     */
    public function getArea(): ?float
    {
        return $this->area;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return null|Contact
     */
    public function getContact(): ?Contact
    {
        return $this->contact;
    }
}
