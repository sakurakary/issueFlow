<?php

declare(strict_types= 1);

namespace App\Tests\Service;

use App\Entity\Ticket;
use App\Service\InMemoryTicketCatalog;
use PHPUnit\Framework\TestCase;
//use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class InMemoryTicketCatalogTest extends TestCase
{

    #[Test]
     public function it_finds_code_and_return_if_exists (): void 
    {
        $catalog = new InMemoryTicketCatalog();
        $ticket = $catalog->findByCode('INC-1002');

        self::assertInstanceOf((Ticket::class), $ticket);
        self::assertSame('INC-1002', $ticket->getCode());
    }

    #[Test]
     public function it_not_finds_id_and_return_if_exists (): void 
    {
        $catalog = new InMemoryTicketCatalog();
        $ticket = $catalog->findByCode('INC-1009');

        self::assertNull($ticket);
    }

    #[Test]
    public function it_returns_current_catalog (): void
    {
        $catalog = new InMemoryTicketCatalog();
        self::assertCount(3, $catalog->all());
    }
}