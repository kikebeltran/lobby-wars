<?php

namespace App\Controller\LobbyWars;

use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Translation\TranslatorInterface;
use LobbyWars\Shared\Infrastructure\Symfony\ApiResponse;
use LobbyWars\Signature\Infrastructure\ResolveWinnerSignatureController as ResolveWinner;

class ResolveWinnerSignatureController
{
    
    protected $translation;
    protected $resolveWinner;

    public function __construct(TranslatorInterface $translator)
    {
        $this->resolveWinner = new ResolveWinner();
        $this->translator = $translator;
    }


    public function test( Request $request ): JsonResponse
    {

        try{

            $result = $this->resolveWinner->__invoke(
                $request->get('signatures') 
            );

            return ApiResponse::success( $this->translator->trans( $result ) );
            
        } catch( Exception $exception ){
            return ApiResponse::error( $this->translator->trans( $exception->getMessage() ) ); 
        }

    }

}

