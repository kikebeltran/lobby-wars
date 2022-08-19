<?php

declare(strict_types=1);

namespace LobbyWars\Signature\Domain;

use LobbyWars\Signature\Domain\LobbyRole;
use LobbyWars\Signature\Domain\Signature;
use LobbyWars\Signature\Domain\ValueObjects\InputSignaturesValueObject;


final class InputSignatures extends InputSignaturesValueObject
{

    public function getFirstSignature(): Signature
    {
        return new Signature(  $this->getArrayValue()[0] );
    }
    
    public function getSecondSignature(): Signature
    {
        return new Signature(  $this->getArrayValue()[2] );
    }

}
