## This is SDK for REST API farento.com

#### How to use

Install package:
```bash
composer require farento/rest-sdk
```

If you use symfony configure services:

* `\Farento\SDK\Service\HttpClient`
* `\Farento\SDK\Service\Router`
* `\Farento\SDK\Service\AuthenticationServiceInterface`
* `\Guzzle\Http\Client`

If not create some tool for it, like `Builder`

Also create Authorization service which will implement `\Farento\SDK\Service\AuthenticationServiceInterface` and inject it to `\Farento\SDK\Service\HttpClient`

#### How to get authorization token

Please write me to admin@farento.com and I will provide it for you.
