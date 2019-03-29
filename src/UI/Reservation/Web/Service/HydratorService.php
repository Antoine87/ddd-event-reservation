<?php

declare(strict_types=1);

namespace App\UI\Reservation\Web\Service;

use Zend\Hydrator\ClassMethodsHydrator;

class HydratorService implements HydratorInterface
{
    private $hydrator;

    public function __construct()
    {
        $this->hydrator = new ClassMethodsHydrator();
    }

    public function hydrate(array $data, object $object): object
    {
        return $this->hydrator->hydrate($data, $object);
    }
}
