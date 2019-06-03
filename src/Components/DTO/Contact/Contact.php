<?php

namespace Farento\SDK\Components\DTO\Contact;

use Farento\SDK\Components\DTO\DTOInterface;

class Contact implements DTOInterface
{
    public const TYPE_OWNER = 'owner';

    public const TYPE_REALTOR = 'realtor';

    public const NO_NAME = '@no-name';

    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var Phone */
    private $phone;

    /** @var null|string */
    private $email;

    /** @var string */
    private $type;

    public function __construct(array $response)
    {
        $this->id    = $response['id'];
        $this->name  = $response['name'];
        $this->type  = $response['type'];
        $this->email = $response['email'] ?? null;

        if (!isset($response['phone']) || null === $response['phone']) {
            return;
        }

        $this->phone = new Phone($response['phone']);
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Phone
     */
    public function getPhone(): Phone
    {
        return $this->phone;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Contact
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
