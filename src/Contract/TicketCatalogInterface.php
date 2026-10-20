<?php

declare(strict_types= 1);

namespace App\Contract;

use App\Model\Ticket;

interface InMemoryTicketCatalogInterface
{

    public function all() : array;
    public function find(string $id): ?Ticket;


}