<?php

namespace App\Tests\Signature\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Translation\TranslatableMessage;

class ResolveWinnerSignatureControllerTest extends WebTestCase
{

    public function testExpectFirst(): void
    {
        $expectedJson = '{"success":true,"data":"Gana la primera firma","message":null}';
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/v1/first-stage', [ "signatures" => "KVK vs NVV" ]);
        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);   
    }

    public function testExpectSecond(): void
    {
        $expectedJson = '{"success":true,"data":"Gana la segunda firma","message":null}';
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/v1/first-stage', [ "signatures" => "NVV vs KKN" ]);
        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);   
    }

    public function testExpectTie(): void
    {
        $expectedJson = '{"success":true,"data":"Hay empate, las dos firmas tienen el mismo valor","message":null}';
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('POST', '/api/v1/first-stage', [ "signatures" => "NVV vs NVV" ]);
        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);   
    }

    public function testExpectInvalid(): void
    {
        
        $expectedJson = '{"success":false,"data":null,"message":"Alguna de las firmas no es correcta"}';
        $client = static::createClient();

        $client->request('POST', '/api/v1/first-stage', [ "signatures" => "NJJ vs NVV" ]);

        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertSame(500, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);   
    }

    public function testExpectInvalidCase2(): void
    {
        
        $expectedJson = '{"success":false,"data":null,"message":"Alguna de las firmas no es correcta"}';
        $client = static::createClient();

        $client->request('POST', '/api/v1/first-stage', [ "signatures" => "" ]);

        $response = $client->getResponse();
        $responseData = $response->getContent();

        $this->assertSame(500, $response->getStatusCode());
        $this->assertEquals($expectedJson,  $responseData);   
    }

}
