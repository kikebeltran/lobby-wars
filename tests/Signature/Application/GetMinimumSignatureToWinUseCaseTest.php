<?php

namespace App\Test\Application;

use PHPUnit\Framework\TestCase;
use LobbyWars\Signature\Domain\Signature;
use LobbyWars\Signature\Application\GetMinimumSignatureToWinUseCase;

class GetMinimumSignatureToWinUseCaseTest extends TestCase
{

    public function testGetMinimumSignatureToWinUseCaseReturnNotary(): void
    {
        $minimumSignature = new GetMinimumSignatureToWinUseCase();
        $this->assertEquals("N", $minimumSignature->__invoke(
            new Signature("N#V"),
            new Signature("NVV"),
        ));   
    }

    public function testGetMinimumSignatureToWinUseCaseReturnKing(): void
    {
        $minimumSignature = new GetMinimumSignatureToWinUseCase();
        $this->assertEquals("K", $minimumSignature->__invoke(
            new Signature("N#V"),
            new Signature("NNN"),
        ));   
    }

    public function testGetMinimumSignatureToWinUseCaseReturnValidator(): void
    {
        $minimumSignature = new GetMinimumSignatureToWinUseCase();
        $this->assertEquals("V", $minimumSignature->__invoke(
            new Signature("N#V"),
            new Signature("VVV"),
        ));   
    }

    public function testExpectNoHashtag(): void
    {

        $this->expectException( \Exception::class );

        $minimumSignature = new GetMinimumSignatureToWinUseCase();
        $this->assertEquals(
            "GetMinimumSignatureToWinUseCase.no_signatures_with_hashtag",
            $minimumSignature->__invoke(
                new Signature("NN"),
                new Signature("VVV"),
            )
        ); 
    }

    public function testExpectNoMoreSignatures(): void
    {
        $minimumSignature = new GetMinimumSignatureToWinUseCase();
        $this->assertEquals(
            "GetMinimumSignatureToWinUseCase.no_more_signatures_needed", 
            $minimumSignature->__invoke(
                new Signature("KK#"),
                new Signature("VVV"),
            )
        ); 
    }

    public function testExpectNotIsPossibleWin(): void
    {
        $minimumSignature = new GetMinimumSignatureToWinUseCase();
        $this->assertEquals(
            "GetMinimumSignatureToWinUseCase.is_not_possible_win", 
            $minimumSignature->__invoke(
                new Signature("NV#"),
                new Signature("KKK"),
            )
        ); 
    }

}
