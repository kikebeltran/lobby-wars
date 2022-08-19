<?php

declare(strict_types=1);

namespace LobbyWars\Signature\Application;

final class ResolveWinnerSignatureUseCase
{


    public function __construct()
    {
    }

    public function __invoke( $signatureOne , $signatureTwo )
    {
        if( $signatureOne->getCalculateValue() > $signatureTwo->getCalculateValue () ){
            return 'ResolveWinnerSignatureUseCase.wins_signature_1';
        }
        else if ( $signatureOne->getCalculateValue() === $signatureTwo->getCalculateValue () ){
            return 'ResolveWinnerSignatureUseCase.same_value';
        }
            
        return 'ResolveWinnerSignatureUseCase.wins_signature_2';
    }
}
