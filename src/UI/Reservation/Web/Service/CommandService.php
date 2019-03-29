<?php

declare(strict_types=1);

namespace App\UI\Reservation\Web\Service;

use App\Application\Reservation\NewReservationCommand;
use LogicException;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Session\SessionInterface;
use Zend\Expressive\Session\SessionMiddleware;

class CommandService implements CommandServiceInterface
{
    private $hydrator;
    private $serializer;

    public function __construct(HydratorInterface $hydrator, SerializerInterface $serializer)
    {
        $this->hydrator = $hydrator;
        $this->serializer = $serializer;
    }

    public function getCommandFromSession(ServerRequestInterface $request): NewReservationCommand
    {
        $reservation = $this->getSession($request)->get(NewReservationCommand::class);

        return $reservation
            ? $this->serializer->unserialize($reservation)
            : new NewReservationCommand();
    }

    public function updateCommandFromSession(ServerRequestInterface $request): NewReservationCommand
    {
        $command = $this->getCommandFromSession($request);
        $this->hydrator->hydrate($request->getParsedBody(), $command);

        $this->getSession($request)->set(NewReservationCommand::class, $this->serializer->serialize($command));

        return $command;
    }

    private function getSession(ServerRequestInterface $request): SessionInterface
    {
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);

        if (!$session) {
            throw new LogicException('No session found from this request');
        }

        return $session;
    }
}
