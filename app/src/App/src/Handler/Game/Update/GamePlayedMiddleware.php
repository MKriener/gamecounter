<?php

declare(strict_types=1);

namespace App\Handler\Game\Update;

use _PHPStan_ae8980142\Nette\Utils\DateTime;
use DateTimeZone;
use Laminas\Diactoros\Response\JsonResponse;
use Laminas\InputFilter\InputFilterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GamePlayedMiddleware implements MiddlewareInterface
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
            return new JsonResponse([$this->inputFilter->getMessages()]);
        }

        $gameRequestPlayed = new GamePlayedRequest(
            $body['name'],
            $body['played'] ?? 1,
            $body['playedLast'] === null
                ? new DateTime('now', new DateTimeZone('UTC'))
                : new DateTime($body['playedLast'], new DateTimeZone('UTC'))
        );

        return $handler->handle($request->withAttribute(GamePlayedRequest::class, $gameRequestPlayed));
    }
}
