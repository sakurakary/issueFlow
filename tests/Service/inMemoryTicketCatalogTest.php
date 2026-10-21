<?php

declare(strict_types= 1);

namespace App\Tests\Service;

use App\Model\Ticket;
use App\Service\inMemoryTicketCatalog;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class inMemoryTicketCatalogTest extends TestCase
{

    #[Test]
     public function it_finds_id_and_return_if_exists (): void 
    {
        $catalog = new inMemoryTicketCatalog();
        $ticket = $catalog->find('INC-1002');

        self::assertInstanceOf((Ticket::class), $ticket);
        self::assertSame('INC-1002', $ticket->getId());
    }

    #[Test]
     public function it_not_finds_id_and_return_if_exists (): void 
    {
        $catalog = new inMemoryTicketCatalog();
        $ticket = $catalog->find('INC-1009');

        self::assertNull($ticket);
    }

    #[Test]
    public function it_returns_current_catalog (): void
    {
        $catalog = new inMemoryTicketCatalog();
        self::assertCount(3, $catalog->all());
    }
}