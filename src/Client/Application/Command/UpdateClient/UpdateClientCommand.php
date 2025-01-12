<?php

declare(strict_types=1);

namespace App\Client\Application\Command\UpdateClient;

use App\Client\Application\Validation\ClientAddressCityRequirements;
use App\Client\Application\Validation\ClientAddressStateRequirements;
use App\Client\Application\Validation\ClientAddressStreetRequirements;
use App\Client\Application\Validation\ClientAddressZipRequirements;
use App\Client\Application\Validation\ClientBirthDateRequirements;
use App\Client\Application\Validation\ClientEmailRequirements;
use App\Client\Application\Validation\ClientFicoRatingRequirements;
use App\Client\Application\Validation\ClientFirstNameRequirements;
use App\Client\Application\Validation\ClientIdRequirements;
use App\Client\Application\Validation\ClientLastNameRequirements;
use App\Client\Application\Validation\ClientPhoneRequirements;
use App\Client\Application\Validation\ClientSsnRequirements;

final readonly class UpdateClientCommand
{
    public function __construct(
        #[ClientIdRequirements]
        public string $id,
        #[ClientLastNameRequirements]
        public string $lastName,
        #[ClientFirstNameRequirements]
        public string $firstName,
        #[ClientBirthDateRequirements]
        public string $birthDate,
        #[ClientSsnRequirements]
        public string $ssn,
        #[ClientFicoRatingRequirements]
        public int $ficoRating,
        #[ClientEmailRequirements]
        public string $email,
        #[ClientPhoneRequirements]
        public string $phone,
        #[ClientAddressStreetRequirements]
        public string $addressStreet,
        #[ClientAddressCityRequirements]
        public string $addressCity,
        #[ClientAddressStateRequirements]
        public string $addressState,
        #[ClientAddressZipRequirements]
        public string $addressZip
    ) {
    }
}