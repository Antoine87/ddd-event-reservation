<?php

declare(strict_types=1);

namespace App\UI\Reservation\Web\Service;

interface HydratorInterface
{
    /**
     * @param mixed[] $data
     * @param object  $object
     *
     * @return object
     */
    public function hydrate(array $data, object $object): object;
}
