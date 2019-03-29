<?php

declare(strict_types=1);

namespace App\UI\Reservation\Web\Service;

use App\Application\Reservation\NewReservationCommand;
use Psr\Http\Message\ServerRequestInterface;

interface CommandServiceInterface
{
    public function getCommandFromSession(ServerRequestInterface $request): NewReservationCommand;

    public function updateCommandFromSession(ServerRequestInterface $request): NewReservationCommand;
}
