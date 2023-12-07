<?php

// app/Exceptions/ApiException.php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ApiException extends ExceptionHandler
{
    public function render($request, Exception $exception)
    {
        if ($request->expectsJson()) {
            $status = 500;
            $message = 'Erro interno no servidor';

            if ($exception instanceof HttpException) {
                $status = $exception->getStatusCode();
                $message = $exception->getMessage();
            }

            return new JsonResponse(['error' => $message], $status);
        }

        return parent::render($request, $exception);
    }
}

