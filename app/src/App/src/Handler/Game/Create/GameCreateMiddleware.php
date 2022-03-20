<?php

declare(strict_types=1);

namespace App\Handler\Game\Create;

use Laminas\Diactoros\Response\JsonResponse;
use Laminas\InputFilter\InputFilterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GameCreateMiddleware implements MiddlewareInterface
{
    public function __construct(
        private readonly InputFilterInterface $gameInputFilter,
    ) {
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        /** @var mixed[] $body */
        $body = $request->getParsedBody();

        $this->gameInputFilter->setData($body);
        if (! $this->gameInputFilter->isValid()) {
            $filteredParams = $this->gameInputFilter->getMessages();

            return new JsonResponse([$filteredParams]);
        }

        $gameCreateRequest = new GameCreateRequest(
            $body['name'],
            $body['description'],
            $body['playerMin'],
            $body['playerMax'],
            $body['startAge'],
            $body['played'] ?? 0,
        );

        return $handler->handle($request->withAttribute(GameCreateRequest::class, $gameCreateRequest));
    }
}
