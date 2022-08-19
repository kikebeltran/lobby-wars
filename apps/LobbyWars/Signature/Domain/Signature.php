<?php

declare(strict_types=1);

namespace LobbyWars\Signature\Domain;

use LobbyWars\Signature\Domain\LobbyRole;
use LobbyWars\Signature\Domain\ValueObjects\SignatureValueObject;


final class Signature extends SignatureValueObject
{

    public function getCalculateValue()
    {

        $calculate = 0;

        $signature = $this->applyRules();

        foreach ( str_split( $signature ) as $value ) {
            $calculate += constant("LobbyWars\Signature\Domain\LobbyRole::{$value}_POINTS");
        }

        return $calculate;

    }

    public function hasHashtag(): bool
    {
        if( str_contains( $this->getValue() , '#') ){
            return true;
        }
        return false;
    }

    private function applyRules(): string
    {
        $signature =  $this->removeHashtag( $this->getValue() );
        return  $this->removeValidatorRoleIfKingExists( $signature );
    }

    private function removeHashtag( $signature ): string
    {
        return str_replace( '#', '',  $signature);
    }

    private function removeValidatorRoleIfKingExists( $signature ): string
    {
        if( str_contains( $signature, LobbyRole::KING_KEY ) ){
           return str_replace( LobbyRole::VALIDATOR_KEY, '', $signature);
        }
        return $signature;
    }
    
}
