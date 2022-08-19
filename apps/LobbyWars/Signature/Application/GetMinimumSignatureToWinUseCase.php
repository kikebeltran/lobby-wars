<?php

declare(strict_types=1);

namespace LobbyWars\Signature\Application;

use LobbyWars\Signature\Domain\LobbyRole;
use LobbyWars\Signature\Domain\Signature;

final class GetMinimumSignatureToWinUseCase
{

    public function __construct()
    {
    }

    public function __invoke( Signature $signatureOne , Signature $signatureTwo )
    {

        if( $signatureOne->hasHashtag() ){
            return $this->calculateLobbyRoleToWin( $signatureOne,  $signatureTwo );
        } else if( $signatureTwo->hasHashtag() ) {
            return $this->calculateLobbyRoleToWin( $signatureTwo,  $signatureOne );
        }

        throw new \Exception( 'GetMinimumSignatureToWinUseCase.no_signatures_with_hashtag' );
        
    }

    private function calculateLobbyRoleToWin( Signature $signatureWithHashtag, Signature $signatureToWin ): string
    {
        if ( $signatureWithHashtag->getCalculateValue() > $signatureToWin->getCalculateValue() ){
            return 'GetMinimumSignatureToWinUseCase.no_more_signatures_needed';
        } else {

            $lobbyRoles = LobbyRole::getRoles();

            foreach ($lobbyRoles as $lobbyRole) {
                if(  
                    $signatureWithHashtag->getCalculateValue() + $lobbyRole['points'] > $signatureToWin->getCalculateValue() 
                ){
                    return $lobbyRole['key'];
                }
            }

            return "GetMinimumSignatureToWinUseCase.is_not_possible_win";

        }
    }

}
