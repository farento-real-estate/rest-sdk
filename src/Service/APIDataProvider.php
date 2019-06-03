<?php

namespace Farento\SDK\Service;

use Farento\SDK\Components\DTO\DTOInterface;
use Farento\SDK\Components\DTO\SimpleDTOInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class APIDataProvider
{
    /** @var HttpClient */
    protected $client;

    /**
     * APIDataProvider constructor.
     *
     * @param HttpClient $client
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $id
     *
     * @throws \Exception
     *
     * @return DTOInterface
     */
    public function getById(int $id): DTOInterface
    {
        $result = $this->client->secureRequest(
            $this->getDefaultRoute() . '/' . $id,
            Request::METHOD_GET
        );

        return $this->createDTO(\json_decode($result, true));
    }

    /**
     * @param SimpleDTOInterface $simpleDto
     *
     * @throws \Exception
     *
     * @return DTOInterface
     */
    public function get(SimpleDTOInterface $simpleDto): DTOInterface
    {
        $list     = $this->getList($simpleDto);
        $response = $list[0] ?? null;

        if (!$response) {
            return $this->createDTO($this->create($simpleDto));
        }

        return $this->createDTO($response);
    }

    /**
     * @param SimpleDTOInterface $simpleDto
     *
     * @throws \Exception
     *
     * @return DTOInterface
     */
    public function post(SimpleDTOInterface $simpleDto): DTOInterface
    {
        return $this->createDTO($this->create($simpleDto));
    }

    /**
     * @param int   $id
     * @param array $parameters
     *
     * @throws \Exception
     */
    public function patch(int $id, array $parameters)
    {
        $this->client->secureRequest(
            $this->getDefaultRoute() . '/' . $id,
            Request::METHOD_PATCH,
            ['Content-Type' => 'application/json'],
            \json_encode($parameters)
        );
    }

    /**
     * @param SimpleDTOInterface $simpleDto
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function getList(SimpleDTOInterface $simpleDto): array
    {
        $query = $this->getQueryString($simpleDto);
        $url   = $this->getListRoute() . $query;

        $response = $this->client->secureRequest($url, Request::METHOD_GET);
        $json     = \json_decode($response, true);

        return $json['data'] ?? [];
    }

    /**
     * @param SimpleDTOInterface $simpleDto
     *
     * @throws \Exception
     *
     * @return \Generator
     */
    public function getListIterator(SimpleDTOInterface $simpleDto): \Generator
    {
        foreach ($this->getList($simpleDto) as $data) {
            if (!isset($data['id'])) {
                continue;
            }

            yield $this->getById($data['id']);
        }
    }

    /**
     * @param SimpleDTOInterface $simpleDto
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function create(SimpleDTOInterface $simpleDto): array
    {
        $result = $this->client->secureRequest(
            $this->getDefaultRoute(),
            Request::METHOD_POST,
            ['Content-Type' => 'application/json'],
            \json_encode($this->getFormData($simpleDto))
        );

        return \json_decode($result, true);
    }

    /**
     * @param array $response
     *
     * @return DTOInterface
     */
    abstract protected function createDTO(array $response): DTOInterface;

    /**
     * @param SimpleDTOInterface $simpleDto
     *
     * @return string
     */
    abstract protected function getQueryString(SimpleDTOInterface $simpleDto): string;

    /**
     * Get list route.
     *
     * @return string
     */
    abstract protected function getListRoute(): string;

    /**
     * Default route for GET, POST, PATCH, DELETE.
     *
     * @return string
     */
    abstract protected function getDefaultRoute(): string;

    /**
     * @param SimpleDTOInterface $simpleDto
     *
     * @return array
     */
    abstract protected function getFormData(SimpleDTOInterface $simpleDto): array;
}
