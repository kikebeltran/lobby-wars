<?php

namespace App\Tests\Application;

use PHPUnit\Framework\TestCase;
use LobbyWars\Signature\Domain\Signature;
use LobbyWars\Signature\Infrastructure\ResolveWinnerSignatureController;
use LobbyWars\Signature\Domain\Exceptions\InvalidInputSignaturesException;

class ResolveWinnerSignatureUseCaseTest extends TestCase
{
    public function testExpectWinFirst(): void
    {
        $winnerSignature = new ResolveWinnerSignatureController();
        $this->assertEquals(
            "ResolveWinnerSignatureUseCase.wins_signature_1", 
            $winnerSignature->__invoke( 
                "KNN vs NVV",
            )
        ); 
    }

    public function testExpectWinSecond(): void
    {
        $winnerSignature = new ResolveWinnerSignatureController();
        $this->assertEquals(
            "ResolveWinnerSignatureUseCase.wins_signature_2", 
            $winnerSignature->__invoke( 
                "NVV vs KNN",
            )
        ); 
    }

    public function testExpectTie(): void
    {
        $winnerSignature = new ResolveWinnerSignatureController();
        $this->assertEquals(
            "ResolveWinnerSignatureUseCase.same_value", 
            $winnerSignature->__invoke( 
                "NVV vs NVV",
            )
        ); 
    }

    public function testExpectInvalid(): void
    {

        $this->expectException( InvalidInputSignaturesException::class );
        
        $winnerSignature = new ResolveWinnerSignatureController();
        $winnerSignature->__invoke( 
            "NVV vs NO",
        ); 
        
    }

    public function testExpectInvalid2(): void
    {

        $this->expectException( InvalidInputSignaturesException::class );
        
        $winnerSignature = new ResolveWinnerSignatureController();
        $winnerSignature->__invoke( 
            "",
        ); 

    }


}
