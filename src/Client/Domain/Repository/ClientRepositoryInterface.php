<?php

declare(strict_types=1);

namespace App\Client\Domain\Repository;

use App\Client\Domain\Entity\Client;
use App\Client\Domain\Entity\Client\ClientEmail;
use App\Client\Domain\Entity\Client\ClientId;
use App\Client\Domain\Entity\Client\ClientPhone;
use App\Client\Domain\Entity\Client\ClientSsn;

interface ClientRepositoryInterface
{
    public function save(Client $client): void;

    public function findById(ClientId $id): ?Client;

    public function findByEmail(ClientEmail $email): ?Client;

    public function findByPhone(ClientPhone $phone): ?Client;

    public function findBySsn(ClientSsn $ssn): ?Client;
}