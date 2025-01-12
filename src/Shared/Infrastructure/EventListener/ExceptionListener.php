<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\EventListener;

use App\Client\Domain\Exception\ClientNotFoundException;
use App\Loan\Domain\Exception\LoanProductNotEligibleException;
use App\Loan\Domain\Exception\LoanProductNotFoundException;
use App\Shared\Application\Exception\ExceptionWithDetailsInterface;
use App\Shared\Application\Validation\ValidationFailedException;
use App\Shared\Domain\Exception\DomainException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Throwable;

final class ExceptionListener
{
    /** @var array<string,int> */
    private const array EXCEPTION_TO_HTTP_CODES_MAPPING = [
        ClientNotFoundException::class => Response::HTTP_NOT_FOUND,
        LoanProductNotEligibleException::class => Response::HTTP_UNPROCESSABLE_ENTITY,
        LoanProductNotFoundException::class => Response::HTTP_NOT_FOUND,
        ValidationFailedException::class => Response::HTTP_UNPROCESSABLE_ENTITY,
    ];

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof HandlerFailedException) {
            $exception = $exception->getPrevious();
        }

        $statusCode = $this->resolveResponseStatusCode($exception);

        $response = [
            'error' => [
                'code' => $statusCode,
                'message' => $exception->getMessage()
            ]
        ];

        if ($exception instanceof ExceptionWithDetailsInterface) {
            $response['error']['details'] = $exception->getDetails();
        }

        $event->setResponse(new JsonResponse($response, $statusCode));
    }

    private function resolveResponseStatusCode(Throwable $exception): int
    {
        if ($exception instanceof DomainException) {
            return self::EXCEPTION_TO_HTTP_CODES_MAPPING[get_class($exception)] ?? Response::HTTP_BAD_REQUEST;
        }

        if ($exception instanceof HttpExceptionInterface) {
            return $exception->getStatusCode();
        }

        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
}