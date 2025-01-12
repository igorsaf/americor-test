<?php

declare(strict_types=1);

namespace App\Client\Domain\Entity\Client;

use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressCity;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressState;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressStreet;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressZip;

final class ClientAddress
{

    public function __construct(
        private ClientAddressStreet $street,
        private ClientAddressCity $city,
        private ClientAddressState $state,
        private ClientAddressZip $zip
    ) {
    }

    public function getStreet(): ClientAddressStreet
    {
        return $this->street;
    }

    public function getCity(): ClientAddressCity
    {
        return $this->city;
    }

    public function getState(): ClientAddressState
    {
        return $this->state;
    }

    public function getZip(): ClientAddressZip
    {
        return $this->zip;
    }

    public function setStreet(ClientAddressStreet $street): void
    {
        $this->street = $street;
    }

    public function setCity(ClientAddressCity $city): void
    {
        $this->city = $city;
    }

    public function setState(ClientAddressState $state): void
    {
        $this->state = $state;
    }

    public function setZip(ClientAddressZip $zip): void
    {
        $this->zip = $zip;
    }

    public function isEquals(self $other): bool
    {
        return array_diff(
            get_object_vars($this),
            get_object_vars($other)
        ) === [];
    }
}