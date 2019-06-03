<?php

namespace Farento\SDK\Service;

use Guzzle\Http\Client;

class HttpClient
{
    private $client;

    private $auth;

    public function __construct(Client $client, AuthenticationServiceInterface $authentication)
    {
        $this->client = $client;
        $this->auth   = $authentication;

        $this->client->setDefaultOption('verify', false);
    }

    /**
     * @param string      $url
     * @param string      $method
     * @param array       $headers
     * @param null|string $body
     * @param array       $options
     *
     * @throws \Exception
     *
     * @return string
     */
    public function request(string $url, string $method, array $headers = [], ?string $body = null, array $options = []): string
    {
        if (!isset($headers['User-Agent'])) {
            $headers['User-Agent'] = 'estate-sdk/1.0 ' . \mt_rand(1000, 9999);
        }

        $request  = $this->client->createRequest($method, $url, $headers, $body, $options);
        $response = $this->client->send($request);

        return $response->getBody(true);
    }

    /**
     * @param string      $url
     * @param string      $method
     * @param array       $headers
     * @param null|string $body
     * @param array       $options
     *
     * @throws \Exception
     *
     * @return string
     */
    public function secureRequest(string $url, string $method, array $headers = [], ?string $body = null, array $options = []): string
    {
        $headers = \array_merge($headers, [
            'Authorization' => $this->auth->getToken(),
        ]);

        return $this->request($url, $method, $headers, $body, $options);
    }
}
