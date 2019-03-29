<?php

declare(strict_types=1);

namespace App\UI\Handler;

use App\Application\Reservation\NewReservationCommand;
use App\UI\Reservation\Web\Service\SerializerInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Session\SessionInterface;
use Zend\Expressive\Session\SessionMiddleware;
use Zend\Expressive\Template\TemplateRendererInterface;

class DebugHandler implements RequestHandlerInterface
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        /** @var TemplateRendererInterface $renderer */
        $renderer = $this->container->get(TemplateRendererInterface::class);
        /** @var SessionInterface $session */
        $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
        /** @var SerializerInterface $serializer */
        $serializer = $this->container->get(SerializerInterface::class);

        $params = [
            'config' => require \dirname(__DIR__, 3) . '/config/config.php',
            'container' => $this->container,
            'session' => $session,
            'renderer' => $this->container->get(TemplateRendererInterface::class),
            'reservation' => null,
        ];

        if ($session && ($reservation = $session->get(NewReservationCommand::class))) {
            $params['reservation'] = $serializer->unserialize($reservation);
        }

        return new HtmlResponse(
            $renderer->render('app::debug', $params)
        );
    }
}
