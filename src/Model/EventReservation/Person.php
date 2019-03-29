<?php

declare(strict_types=1);

namespace App\Model\EventReservation;

class Person
{
    /**
     * @var string
     */
    private $givenName;

    /**
     * @var string|null
     */
    private $familyName;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string|null
     */
    private $telephone;

    public function __construct(string $givenName, string $email, string $familyName = null, string $telephone = null)
    {
        $this->givenName = $givenName;
        $this->familyName = $familyName;
        $this->email = $email;
        $this->telephone = $telephone;
    }

    public function getGivenName(): string
    {
        return $this->givenName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    /** @internal For Doctrine */
    private $id;
}
