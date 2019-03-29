<?php

declare(strict_types=1);

namespace App\UI\Reservation\Web;

use App\Application\Reservation\ReservationServiceInterface;
use App\UI\Reservation\Web\Service\CommandServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;

class ReservationSubmitHandler implements RequestHandlerInterface
{
    private $router;
    private $reservation;
    private $command;

    public function __construct(
        RouterInterface $router,
        ReservationServiceInterface $reservation,
        CommandServiceInterface $command
    ) {
        $this->router = $router;
        $this->reservation = $reservation;
        $this->command = $command;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $step = $request->getAttribute('step');

        if ($step === 'event') {
            $this->command->updateCommandFromSession($request);

            return new RedirectResponse(
                $this->router->generateUri('reservation.steps', [
                    'step' => 'name'
                ])
            );
        }
        if ($step === 'name') {
            $command = $this->command->updateCommandFromSession($request);
            $this->reservation->makeReservation($command);

            return new RedirectResponse(
                $this->router->generateUri('reservation.steps', [
                    'step' => 'confirmation'
                ])
            );
        }

        return new RedirectResponse(
            $this->router->generateUri('reservation.steps', [
                'step' => 'name'
            ])
        );
    }
}
