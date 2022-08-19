<?php

declare(strict_types=1);

namespace LobbyWars\Signature\Domain\ValueObjects;

use LobbyWars\Signature\Domain\Exceptions\InvalidLobbyRoleException;

abstract class LobbyRoleValueObject
{
    
    public function __construct(protected string $value)
    {

        $called_class = explode( "\\", get_called_class() );

        if( !preg_match('/^[NVK]{1}$/', $value) ) 
            throw new InvalidLobbyRoleException('Invalid ' . $called_class[ count( $called_class  ) - 1 ] );
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
