<?php

namespace Farento\SDK\Components\DTO\Estate;

use Farento\SDK\Components\DTO\Advert\AdvertGroup;
use Farento\SDK\Components\DTO\DTOInterface;
use Doctrine\Common\Collections\ArrayCollection;

class Estate implements DTOInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var AdvertGroup[]|array */
    private $advertGroups;

    public function __construct(array $response)
    {
        $this->id           = $response['id'];
        $this->name         = $response['name'];
        $this->advertGroups = new ArrayCollection();

        foreach ($response['advert_groups'] as $advert_group) {
            $this->advertGroups->add(new AdvertGroup($advert_group));
        }
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
     * @return AdvertGroup[]|ArrayCollection
     */
    public function getAdvertGroups(): ArrayCollection
    {
        return $this->advertGroups;
    }
}
