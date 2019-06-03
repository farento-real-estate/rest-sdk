<?php

namespace Farento\SDK\Components\DTO\Advert;

use Farento\SDK\Components\DTO\Advert\Advert;
use Farento\SDK\Components\DTO\DTOInterface;
use Farento\SDK\Components\DTO\Site;
use Doctrine\Common\Collections\ArrayCollection;

class AdvertGroup implements DTOInterface
{
    public const STATUS_PENDING = '0';

    public const STATUS_SUCCESS = '1';

    public const ADVERT_GROUP_RESOURCE = 'App\Entity\AdvertGroup';

    /** @var int */
    private $id;

    /** @var string */
    private $status;

    /** @var string */
    private $name;

    /** @var Site */
    private $site;

    /** @var string */
    private $sourceId;

    /** @var Advert[]|ArrayCollection */
    private $adverts;

    public function __construct(array $response)
    {
        $this->adverts  = new ArrayCollection();
        $this->id       = $response['id'];
        $this->sourceId = $response['source_id'];
        $this->site     = new Site($response['site']);
        $this->status   = (string) $response['status'];
        $this->name     = $response['name'];

        foreach ($response['adverts'] ?? [] as $advert) {
            $this->adverts->add(new Advert($advert));
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
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Site
     */
    public function getSite(): Site
    {
        return $this->site;
    }

    /**
     * @return string
     */
    public function getSourceId(): string
    {
        return $this->sourceId;
    }

    /**
     * @return Advert[]|ArrayCollection
     */
    public function getAdverts(): ArrayCollection
    {
        return $this->adverts;
    }
}
