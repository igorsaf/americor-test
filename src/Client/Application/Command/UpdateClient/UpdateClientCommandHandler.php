<?php

declare(strict_types=1);

namespace App\Client\Application\Command\UpdateClient;

use App\Client\Domain\Entity\Client;
use App\Client\Domain\Entity\Client\ClientAddress;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressCity;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressState;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressStreet;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressZip;
use App\Client\Domain\Entity\Client\ClientEmail;
use App\Client\Domain\Entity\Client\ClientFicoRating;
use App\Client\Domain\Entity\Client\ClientFirstName;
use App\Client\Domain\Entity\Client\ClientId;
use App\Client\Domain\Entity\Client\ClientLastName;
use App\Client\Domain\Entity\Client\ClientPhone;
use App\Client\Domain\Entity\Client\ClientSsn;
use App\Client\Domain\Exception\ClientAlreadyExistException;
use App\Client\Domain\Exception\ClientNotFoundException;
use App\Client\Domain\Repository\ClientRepositoryInterface;
use DateTimeImmutable;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class UpdateClientCommandHandler
{
    public function __construct(
        private ClientRepositoryInterface $clientRepository,
    )
    {
    }

    public function __invoke(UpdateClientCommand $command): void
    {
        $id = ClientId::fromString($command->id);

        $client = $this->clientRepository->findById($id);
        if ($client === null) {
            throw new ClientNotFoundException($id);
        }
        
        $this->checkIsNewEmailNotAlreadyUsed($client, $command);
        $this->checkIsNewPhoneNotAlreadyUsed($client, $command);
        $this->checkIsNewSsnNotAlreadyUsed($client, $command);

        $client->updateFromValues(
            ClientLastName::fromString($command->lastName),
            ClientFirstName::fromString($command->firstName),
            DateTimeImmutable::createFromFormat('Y-m-d', $command->birthDate),
            ClientSsn::fromString($command->ssn),
            ClientFicoRating::fromInt($command->ficoRating),
            ClientEmail::fromString($command->email),
            ClientPhone::fromString($command->phone),
            new ClientAddress(
                ClientAddressStreet::fromString($command->addressStreet),
                ClientAddressCity::fromString($command->addressCity),
                ClientAddressState::fromString($command->addressState),
                ClientAddressZip::fromString($command->addressZip)
            ),
            new DateTimeImmutable()
        );

        $this->clientRepository->save($client);
    }
    
    private function checkIsNewEmailNotAlreadyUsed(Client $client, UpdateClientCommand $command): void
    {
        if ($client->getEmail()->value() === $command->email) {
            return;
        }
        
        $clientWithPassedEmail = $this->clientRepository->findByEmail(ClientEmail::fromString($command->email));
        if ($clientWithPassedEmail === null) {
            return;
        }
        
        if ($clientWithPassedEmail === $client) {
            return;
        }

        throw new ClientAlreadyExistException('email', $command->email);
    }
    
    private function checkIsNewPhoneNotAlreadyUsed(Client $client, UpdateClientCommand $command): void
    {
        if ($client->getPhone()->value() === $command->phone) {
            return;
        }
        
        $clientWithPassedPhone = $this->clientRepository->findByPhone(ClientPhone::fromString($command->phone));
        if ($clientWithPassedPhone === null) {
            return;
        }
        
        if ($clientWithPassedPhone === $client) {
            return;
        }

        throw new ClientAlreadyExistException('phone', $command->phone);
    }
    
    private function checkIsNewSsnNotAlreadyUsed(Client $client, UpdateClientCommand $command): void
    {
        if ($client->getSsn()->value() === $command->ssn) {
            return;
        }
        
        $clientWithPassedSsn = $this->clientRepository->findBySsn(ClientSsn::fromString($command->ssn));
        if ($clientWithPassedSsn === null) {
            return;
        }
        
        if ($clientWithPassedSsn === $client) {
            return;
        }

        throw new ClientAlreadyExistException('ssn', $command->ssn);
    }
}