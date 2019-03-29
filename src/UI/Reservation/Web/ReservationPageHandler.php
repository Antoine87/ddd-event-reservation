<?php

declare(strict_types=1);

namespace App\UI\Reservation\Web;

use App\UI\Reservation\Facade\ReservationFacadeInterface;
use App\UI\Reservation\Web\Service\CommandServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class ReservationPageHandler implements RequestHandlerInterface
{
    private $renderer;
    private $router;
    private $reservation;
    private $command;

    public function __construct(
        TemplateRendererInterface $renderer,
        RouterInterface $router,
        ReservationFacadeInterface $reservation,
        CommandServiceInterface $command
    ) {
        $this->renderer = $renderer;
        $this->router = $router;
        $this->reservation = $reservation;
        $this->command = $command;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $step = $request->getAttribute('step');

        if ($step === 'event') {
            return new HtmlResponse(
                $this->renderer->render('reservation::event-page', [
                    'events' => $this->reservation->listAllEvents()
                ])
            );
        }
        if ($step === 'name') {
            $eventSlug = $this->command->getCommandFromSession($request)->getEventSlug();
            if ($eventSlug) {
                return new HtmlResponse(
                    $this->renderer->render('reservation::name-page', [
                        'selectedEvent' => $eventSlug
                    ])
                );
            }
        }
        if ($step === 'confirmation') {
            return new HtmlResponse(
                $this->renderer->render('reservation::confirmation-page')
            );
        }

        // Redirect to the first step of the reservation process
        return new RedirectResponse(
            $this->router->generateUri('reservation.steps', [
                'step' => 'event'
            ])
        );
    }
}
