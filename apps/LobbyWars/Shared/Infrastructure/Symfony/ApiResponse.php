<?php

declare(strict_types=1);

namespace LobbyWars\Shared\Infrastructure\Symfony;

use Symfony\Component\HttpFoundation\JsonResponse;

final class ApiResponse
{

    public static function success( $data = null, string $message = null, int $code = 200 ): JsonResponse
    {
        return self::response( $data, $message, $code, true );
    }

    public static function error( string $message = null, int $code = 500 ): JsonResponse
    {
        return self::response( null, $message, $code, false );
    }

    public static function response( $data = null, string $message = null, int $code = 200, bool $success = true )
    {
        return new JsonResponse(
            [
                'success'   => $success,
                'data'      => $data,
                'message'   => $message,
            ],
            $code
        );
    }

}
