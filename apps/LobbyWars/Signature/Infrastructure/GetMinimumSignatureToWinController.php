<?php

declare(strict_types=1);

namespace LobbyWars\Signature\Infrastructure;

use LobbyWars\Signature\Domain\Signature;
use LobbyWars\Signature\Domain\InputSignatures;
use LobbyWars\Signature\Application\ResolveWinnerSignatureUseCase;
use LobbyWars\Signature\Application\GetMinimumSignatureToWinUseCase;

final class GetMinimumSignatureToWinController
{

    private $GetMinimumSignatureToWinUseCase;

    public function __construct()
    {
        $this->GetMinimumSignatureToWinUseCase = new GetMinimumSignatureToWinUseCase();
    }

    public function __invoke( string $params )
    {

        $signatures = new InputSignatures( $params );

        return $this->GetMinimumSignatureToWinUseCase->__invoke(
            $signatures->getFirstSignature(),
            $signatures->getSecondSignature(),
        );
        
    }
}
