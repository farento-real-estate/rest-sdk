<?php

namespace Farento\SDK\Components\DTO\Google\Drive;

use Farento\SDK\Components\DTO\DTOInterface;

class GoogleFile implements DTOInterface
{
    /** @var int */
    private $id;

    /** @var string */
    private $fileId;

    /** @var GoogleFolder */
    private $folder;

    /** @var string */
    private $teamDriveId;

    /** @var int */
    private $size;

    /** @var string */
    private $webViewLink;

    /** @var string */
    private $hash;

    public function __construct(array $response)
    {
        $this->id          = $response['id'];
        $this->fileId      = $response['file_id'];
        $this->folder      = new GoogleFolder($response['folder']);
        $this->teamDriveId = $response['team_drive_id'];
        $this->size        = $response['size'];
        $this->webViewLink = $response['web_view_link'];
        $this->hash        = $response['sha256hash'];
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
    public function getFileId(): string
    {
        return $this->fileId;
    }

    /**
     * @return GoogleFolder
     */
    public function getFolder(): GoogleFolder
    {
        return $this->folder;
    }

    /**
     * @return string
     */
    public function getTeamDriveId(): string
    {
        return $this->teamDriveId;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getWebViewLink(): string
    {
        return $this->webViewLink;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }
}
