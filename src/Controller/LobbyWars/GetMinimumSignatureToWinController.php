<?php

namespace App\Controller\LobbyWars;

use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Translation\TranslatorInterface;
use LobbyWars\Shared\Infrastructure\Symfony\ApiResponse;
use LobbyWars\Signature\Infrastructure\GetMinimumSignatureToWinController as GetMinimumSignatureToWinner;

class GetMinimumSignatureToWinController
{
    protected $getMinimumSignatureToWinner;
    protected $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->getMinimumSignatureToWinner = new GetMinimumSignatureToWinner();
        $this->translator = $translator;
    }

    public function test( Request $request ): JsonResponse
    {
        
        try{

            $result = $this->getMinimumSignatureToWinner->__invoke(
                $request->get( 'signatures' )
            );

            return ApiResponse::success( $this->translator->trans( $result ) );
            
        } catch( Exception $exception ){
            return ApiResponse::error( $this->translator->trans( $exception->getMessage() ) ); 
        }

    }

}

