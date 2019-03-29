<?php

declare(strict_types=1);

namespace App\Application\Reservation;

class NewReservationCommand
{
    /**
     * @var string|null
     */
    private $eventSlug;

    /**
     * @var string|null
     */
    private $personGivenName;

    /**
     * @var string|null
     */
    private $personFamilyName;

    /**
     * @var string|null
     */
    private $personEmail;

    /**
     * @var string|null
     */
    private $personTelephone;

    public function getEventSlug(): ?string
    {
        return $this->eventSlug;
    }

    public function setEventSlug(string $eventSlug): self
    {
        $this->eventSlug = $eventSlug;

        return $this;
    }

    public function getPersonGivenName(): ?string
    {
        return $this->personGivenName;
    }

    public function setPersonGivenName(string $personGivenName): self
    {
        $this->personGivenName = $personGivenName;

        return $this;
    }

    public function getPersonFamilyName(): ?string
    {
        return $this->personFamilyName;
    }

    public function setPersonFamilyName(string $personFamilyName): self
    {
        $this->personFamilyName = $personFamilyName;

        return $this;
    }

    public function getPersonEmail(): ?string
    {
        return $this->personEmail;
    }

    public function setPersonEmail(string $personEmail): self
    {
        $this->personEmail = $personEmail;

        return $this;
    }

    public function getPersonTelephone(): ?string
    {
        return $this->personTelephone;
    }

    public function setPersonTelephone(string $personTelephone): self
    {
        $this->personTelephone = $personTelephone;

        return $this;
    }
}
