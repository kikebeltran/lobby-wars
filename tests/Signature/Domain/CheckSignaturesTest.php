<?php

namespace App\Tests\Signature\Domain;

use PHPUnit\Framework\TestCase;
use LobbyWars\Signature\Domain\LobbyRole;
use LobbyWars\Signature\Domain\Signature;
use LobbyWars\Signature\Domain\InputSignatures;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use LobbyWars\Signature\Domain\Exceptions\InvalidLobbyRoleException;
use LobbyWars\Signature\Domain\Exceptions\InvalidSignatureException;
use LobbyWars\Signature\Domain\Exceptions\InvalidInputSignaturesException;

class CheckSignaturesTest extends TestCase
{

    public function testItShouldAcceptSignature(): void
    {
        $initialValue = "KNN";
        $signature = new Signature( $initialValue );
        $this->assertEquals($initialValue, $signature->getValue());

    }

    public function testItShouldRejectSignature(): void
    {
        $this->expectException( InvalidSignatureException::class );
        $signature = new Signature( "OO" );
    }

    public function testItShouldAcceptInputSignatures(): void
    {
        $signature = new InputSignatures( "KNN vs KK" );
        $this->assertTrue(true);
    }

    public function testItShouldRejectInputSignatures(): void
    {
        $this->expectException( InvalidInputSignaturesException::class );
        $signature = new InputSignatures( "KNN vsKK" );
    }

    public function testItShouldCountSignatureValue(): void
    {
        $signature = new Signature( "KNN" );
        $this->assertEquals(9, $signature->getCalculateValue());
    }

    public function testItShouldCountSignatureValueCase2(): void
    {
        $signature = new Signature( "KNN" );
        $sum = 0;
        $sum += LobbyRole::K_POINTS;
        $sum += LobbyRole::N_POINTS;
        $sum += LobbyRole::N_POINTS;
        $this->assertEquals($sum, $signature->getCalculateValue());
    }

    public function testItShouldAcceptKingRole(): void
    {
        $initialValue = LobbyRole::KING_KEY;
        $signature = new LobbyRole( $initialValue );
        $this->assertEquals($initialValue, $signature->getValue());
    }
    
    public function testItShouldAcceptNotaryRole(): void
    {
        $initialValue = LobbyRole::NOTARY_KEY;
        $signature = new LobbyRole( $initialValue );
        $this->assertEquals($initialValue, $signature->getValue());
    }
    
    public function testItShouldAcceptValidatorRole(): void
    {
        $initialValue = LobbyRole::VALIDATOR_KEY;
        $signature = new LobbyRole( $initialValue );
        $this->assertEquals($initialValue, $signature->getValue());
    }
    
    public function testItShouldRejectHashtag(): void
    {
        $this->expectException( InvalidLobbyRoleException::class );
        $signature = new LobbyRole( "#" );
    }

    public function testItShouldRejectAnyOtherCharacter(): void
    {
        $this->expectException( InvalidLobbyRoleException::class );
        
        $string = "ABCDEFGHIJLMOPQRSTUWXYZ";
        $signature = new LobbyRole( $string[ rand(0, strlen( $string ) - 1) ] );
    }


}
