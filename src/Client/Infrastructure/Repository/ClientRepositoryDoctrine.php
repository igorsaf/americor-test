<?php

declare(strict_types=1);

namespace App\Client\Infrastructure\Repository;

use App\Client\Domain\Entity\Client;
use App\Client\Domain\Entity\Client\ClientEmail;
use App\Client\Domain\Entity\Client\ClientId;
use App\Client\Domain\Entity\Client\ClientPhone;
use App\Client\Domain\Entity\Client\ClientSsn;
use App\Client\Domain\Repository\ClientRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final readonly class ClientRepositoryDoctrine implements ClientRepositoryInterface
{

    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function save(Client $client): void
    {
        $this->entityManager->persist($client);
        $this->entityManager->flush();
    }

    public function findById(ClientId $id): ?Client
    {
        return $this->entityManager->getRepository(Client::class)->find($id);
    }

    public function findByEmail(ClientEmail $email): ?Client
    {
        return $this->entityManager->getRepository(Client::class)->findOneBy(['email' => $email]);
    }

    public function findByPhone(ClientPhone $phone): ?Client
    {
        return $this->entityManager->getRepository(Client::class)->findOneBy(['phone' => $phone]);
    }

    public function findBySsn(ClientSsn $ssn): ?Client
    {
        return $this->entityManager->getRepository(Client::class)->findOneBy(['ssn' => $ssn]);
    }
}