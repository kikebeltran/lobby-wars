<?php

declare(strict_types=1);

namespace LobbyWars\Signature\Domain;

use LobbyWars\Signature\Domain\ValueObjects\LobbyRoleValueObject;


final class LobbyRole extends LobbyRoleValueObject
{

    const K_POINTS = 5;
    const KING_KEY = 'K';

    const N_POINTS = 2;
    const NOTARY_KEY = 'N';

    const V_POINTS = 1;
    const VALIDATOR_KEY = 'V';

    public function points(): int
    {

        switch ( $this->getValue() ) {
            case self::KING_KEY:
                return self::K_POINTS;
            break;
            case self::NOTARY_KEY:
                return self::N_POINTS;
            break;
            case self::VALIDATOR_KEY:
                return self::V_POINTS;
            break;
            default:
                return 0;
            break;
        }
        
    }

    public static function getRoles(): array
    {
        return [
            [ 
                'key' => self::VALIDATOR_KEY,
                'points' => self::V_POINTS
            ],
            [ 
                'key' => self::NOTARY_KEY,
                'points' => self::N_POINTS
            ],
            [ 
                'key' => self::KING_KEY,
                'points' => self::K_POINTS
            ]
            ];
    }


}
