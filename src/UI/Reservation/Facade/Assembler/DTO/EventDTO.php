<?php

declare(strict_types=1);

namespace App\UI\Reservation\Facade\Assembler\DTO;

class EventDTO
{
    use PropertyAccessTrait;

    private $slug;
    private $name;
    private $description;
    private $imageURL;

    public function __construct(
        string $slug,
        string $name,
        string $description,
        string $imageURL
    ) {
        $this->slug = $slug;
        $this->name = $name;
        $this->description = $description;
        $this->imageURL = $imageURL;
    }
}
