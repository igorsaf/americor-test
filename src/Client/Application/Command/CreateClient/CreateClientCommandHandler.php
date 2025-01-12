<?php

declare(strict_types=1);

namespace App\Client\Application\Command\CreateClient;

use App\Client\Domain\Entity\Client;
use App\Client\Domain\Entity\Client\ClientAddress;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressCity;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressState;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressStreet;
use App\Client\Domain\Entity\Client\ClientAddress\ClientAddressZip;
use App\Client\Domain\Entity\Client\ClientBirthDate;
use App\Client\Domain\Entity\Client\ClientEmail;
use App\Client\Domain\Entity\Client\ClientFicoRating;
use App\Client\Domain\Entity\Client\ClientFirstName;
use App\Client\Domain\Entity\Client\ClientId;
use App\Client\Domain\Entity\Client\ClientLastName;
use App\Client\Domain\Entity\Client\ClientPhone;
use App\Client\Domain\Entity\Client\ClientSsn;
use App\Client\Domain\Exception\ClientAlreadyExistException;
use App\Client\Domain\Repository\ClientRepositoryInterface;
use DateTimeImmutable;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class CreateClientCommandHandler
{
    public function __construct(
        private ClientRepositoryInterface $clientRepository,
    )
    {
    }

    /**
     * @throws ClientAlreadyExistException
     */
    public function __invoke(CreateClientCommand $command): ClientId
    {
        if ($this->clientRepository->findByEmail(ClientEmail::fromString($command->email)) !== null) {
            throw new ClientAlreadyExistException('email', $command->email);
        }

        if ($this->clientRepository->findByPhone(ClientPhone::fromString($command->phone)) !== null) {
            throw new ClientAlreadyExistException('phone', $command->phone);
        }

        if ($this->clientRepository->findBySsn(ClientSsn::fromString($command->ssn)) !== null) {
            throw new ClientAlreadyExistException('ssn', $command->ssn);
        }

        $client = new Client(
            ClientId::next(),
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
            new DateTimeImmutable(),
            new DateTimeImmutable(),
        );

        $this->clientRepository->save($client);

        return $client->getId();
    }
}