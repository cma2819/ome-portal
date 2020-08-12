<?php

namespace Ome\Auth\Interfaces\UseCases\ExchangeAuthenticateCode;

/**
 * Exchange Authenticate Code.
 */
interface ExchangeAuthenticateCodeUseCase
{
    /**
     * Exchange Authenticate Code.
     */
    public function interact(ExchangeAuthenticateCodeRequest $request): ExchangeAuthenticateCodeResponse;
}
