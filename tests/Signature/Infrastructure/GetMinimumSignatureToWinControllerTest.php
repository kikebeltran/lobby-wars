<?php

namespace App\Tests\Signature\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GetMinimumSignatureToWinControllerTest extends WebTestCase
{
    public function testExpectN(): void
    {

        $expectedJson = '{"success":true,"data":"N","message":null}';
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/v1/second-stage', [ "signatures" => "N#V vs NVV" ]);
        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);
        
    }

    public function testExpectK(): void
    {

        $expectedJson = '{"success":true,"data":"K","message":null}';
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/v1/second-stage', [ "signatures" => "N#V vs KVV" ]);
        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);
        
    }

    public function testExpectV(): void
    {

        $expectedJson = '{"success":true,"data":"V","message":null}';
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/v1/second-stage', [ "signatures" => "N#V vs VVV" ]);
        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);
        
    }
    
    public function testExpectWinWithHashtag(): void
    {

        $expectedJson = '{"success":true,"data":"No hacen falta m\u00e1s firmas, la que tiene el hashtag ya gana.","message":null}';
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/v1/second-stage', [ "signatures" => "K#V vs VVV" ]);
        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);
        
    }
    
    public function testExpectNoPossibleWin(): void
    {

        $expectedJson = '{"success":true,"data":"No se puede ganar a la otra firma.","message":null}';
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/v1/second-stage', [ "signatures" => "K#V vs KKN" ]);
        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);
        
    }
    
    
    public function testExpectNoHashtags(): void
    {

        $expectedJson = '{"success":false,"data":null,"message":"No hay firmas con hashtag"}';
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/v1/second-stage', [ "signatures" => "KV vs KKN" ]);
        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertSame(500, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);
        
    }
    

}
