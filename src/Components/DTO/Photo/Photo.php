<?php

namespace Farento\SDK\Components\DTO\Photo;

use Farento\SDK\Components\DTO\DTOInterface;
use Farento\SDK\Components\DTO\Google\Drive\GoogleFile;

class Photo implements DTOInterface
{
    public const DEFAULT_FOLDER_NAME = 'Images';

    public const DEFAULT_PREVIEW_NAME = 'Preview';

    /** @var int */
    private $id;

    /** @var string */
    private $hash;

    /** @var GoogleFile */
    private $googleFile;

    public function __construct(array $response)
    {
        $this->id         = $response['id'];
        $this->hash       = $response['hash'];
        $this->googleFile = new GoogleFile($response['google_file']);
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
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @return GoogleFile
     */
    public function getGoogleFile(): GoogleFile
    {
        return $this->googleFile;
    }
}
