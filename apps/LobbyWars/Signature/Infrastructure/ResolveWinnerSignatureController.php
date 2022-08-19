<?php

declare(strict_types=1);

namespace LobbyWars\Signature\Infrastructure;

use LobbyWars\Signature\Application\ResolveWinnerSignatureUseCase;
use LobbyWars\Signature\Domain\Signature;
use LobbyWars\Signature\Domain\InputSignatures;

final class ResolveWinnerSignatureController
{

    private $resolveWinnerUseCase;

    public function __construct()
    {
        $this->resolveWinnerUseCase = new ResolveWinnerSignatureUseCase();
    }

    public function __invoke( string $params )
    {

        $signatures = new InputSignatures( $params );

        return $this->resolveWinnerUseCase->__invoke(
            $signatures->getFirstSignature(),
            $signatures->getSecondSignature(),
        );
        
    }
}
