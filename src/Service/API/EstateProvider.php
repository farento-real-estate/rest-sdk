<?php

namespace Farento\SDK\Service\Estate;

use Farento\SDK\Components\DTO\DTOInterface;
use Farento\SDK\Components\DTO\Estate\Estate;
use Farento\SDK\Components\DTO\Estate\EstateParams;
use Farento\SDK\Components\DTO\SimpleDTOInterface;
use Farento\SDK\Service\APIDataProvider;
use Farento\SDK\Service\HttpClient;
use Farento\SDK\Service\Router;

class EstateProvider extends APIDataProvider
{
    private $router;

    public function __construct(HttpClient $client, Router $router)
    {
        parent::__construct($client);

        $this->router = $router;
    }

    protected function createDTO(array $response): DTOInterface
    {
        return new Estate($response);
    }

    /**
     * @param SimpleDTOInterface $simpleDto
     *
     * @return string
     */
    protected function getQueryString(SimpleDTOInterface $simpleDto): string
    {
        return '';
    }

    protected function getDefaultRoute(): string
    {
        return $this->router->estate();
    }

    protected function getListRoute(): string
    {
        return $this->router->estateList();
    }

    /**
     * @param EstateParams|SimpleDTOInterface $simpleDto
     *
     * @return array
     */
    protected function getFormData(SimpleDTOInterface $simpleDto): array
    {
        return [
            'estate' => [
                'name' => $simpleDto->getName(),
            ],
        ];
    }
}
