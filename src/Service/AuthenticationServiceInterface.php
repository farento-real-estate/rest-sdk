<?php

namespace Farento\SDK\Service;

interface AuthenticationServiceInterface
{
    /**
     * Get authorization token.
     *
     * @return string
     */
    public function getToken(): string;
}
