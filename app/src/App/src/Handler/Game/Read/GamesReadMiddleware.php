<?php

declare(strict_types=1);

namespace App\Handler\Game\Read;

use DateTime;
use DateTimeZone;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\InputFilter\InputFilterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function count;

class GamesReadMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly InputFilterInterface $inputFilter
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var mixed[] $body */
        $body = $request->getParsedBody();

        $this->inputFilter->setData($body);

        if (! $this->inputFilter->isValid()) {
            return new JsonResponse($this->inputFilter->getMessages());
        }

        if (count($this->inputFilter->getValidInput()) === 0) {
            return new JsonResponse('At least one filter should be used.');
        }

        $gameReadRequest = new GamesReadRequest(
            $body['name'] ?? null,
            $body['played'] ?? null,
            $body['playerMin'] ?? null,
            $body['playerMax'] ?? null,
            $body['startAge'] ?? null,
            $body['playedLast'] === null ? null : new DateTime($body['playedLast'], new DateTimeZone('UTC')),
        );

        return $handler->handle($request->withAttribute(GamesReadRequest::class, $gameReadRequest));
    }
}
