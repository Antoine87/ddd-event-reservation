<?php

declare(strict_types=1);

use App\UI\Handler;
use App\UI\Reservation;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Application;
use Zend\Expressive\MiddlewareFactory;

/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/:id', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/:id', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', Handler\HomePageHandler::class, 'home');

    // The above should just redirect to the first step of the reservation process
    $app->get('/reservation', Reservation\Web\ReservationPageHandler::class, 'reservation.home');

    $app->get('/reservation/{step}', Reservation\Web\ReservationPageHandler::class, 'reservation.steps');
    $app->post('/reservation/{step}', Reservation\Web\ReservationSubmitHandler::class, 'reservation.submit');

    $app->get('/api/ping', Handler\PingHandler::class, 'api.ping');
    $app->get('/debug', Handler\DebugHandler::class, 'debug');
};
