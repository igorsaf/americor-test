<?php

declare(strict_types=1);

namespace App\Client\Domain\Entity;

use App\Client\Domain\Entity\Client\ClientAddress;
use App\Client\Domain\Entity\Client\ClientEmail;
use App\Client\Domain\Entity\Client\ClientFicoRating;
use App\Client\Domain\Entity\Client\ClientFirstName;
use App\Client\Domain\Entity\Client\ClientId;
use App\Client\Domain\Entity\Client\ClientLastName;
use App\Client\Domain\Entity\Client\ClientPhone;
use App\Client\Domain\Entity\Client\ClientSsn;
use DateTimeImmutable;

final class Client
{

    public function __construct(
        private readonly ClientId $id,
        private ClientLastName $lastName,
        private ClientFirstName $firstName,
        private DateTimeImmutable $birthDate,
        private ClientSsn $ssn,
        private ClientFicoRating $ficoRating,
        private ClientEmail $email,
        private ClientPhone $phone,
        private ClientAddress $address,
        private readonly DateTimeImmutable $createdAt,
        private DateTimeImmutable $updatedAt
    ) {
    }

    public function getId(): ClientId
    {
        return $this->id;
    }

    public function getLastName(): ClientLastName
    {
        return $this->lastName;
    }

    public function getFirstName(): ClientFirstName
    {
        return $this->firstName;
    }

    public function getBirthDate(): DateTimeImmutable
    {
        return $this->birthDate;
    }

    public function getSsn(): ClientSsn
    {
        return $this->ssn;
    }

    public function getFicoRating(): ClientFicoRating
    {
        return $this->ficoRating;
    }

    public function getEmail(): ClientEmail
    {
        return $this->email;
    }

    public function getPhone(): ClientPhone
    {
        return $this->phone;
    }

    public function getAddress(): ClientAddress
    {
        return $this->address;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function updateFromValues(
        ClientLastName $lastName,
        ClientFirstName $firstName,
        DateTimeImmutable $birthDate,
        ClientSsn $ssn,
        ClientFicoRating $ficoRating,
        ClientEmail $email,
        ClientPhone $phone,
        ClientAddress $address,
        DateTimeImmutable $updatedAt
    ): void {

        if (
            $this->lastName === $lastName
            && $this->firstName === $firstName
            && $this->birthDate === $birthDate
            && $this->ssn === $ssn
            && $this->ficoRating === $ficoRating
            && $this->email === $email
            && $this->phone === $phone
            && $this->address->isEquals($address)
        ) {
            return;
        }

        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->birthDate = $birthDate;
        $this->ssn = $ssn;
        $this->ficoRating = $ficoRating;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->updatedAt = $updatedAt;
    }

}