<?php

declare(strict_types=1);

namespace LobbyWars\Signature\Domain\ValueObjects;

use LobbyWars\Signature\Domain\Exceptions\InvalidInputSignaturesException;

abstract class InputSignaturesValueObject
{
    
    public function __construct(protected string $value)
    {

        $called_class = explode( "\\", get_called_class() );

        if( !preg_match('/^[NVK#]{2,3}+ vs +[NVK#]{2,3}$/', $value) || substr_count( $value, '#' ) > 1) 
            throw new InvalidInputSignaturesException('Invalid ' . $called_class[ count( $called_class  ) - 1 ] );
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getArrayValue(): array
    {
        return explode( ' ', $this->value );
    }
}