<?php

declare(strict_types=1);

namespace App\Service;

use App\Contract\TicketCatalogInterface;
use App\Entity\Ticket;
use App\Model\TicketPriority;
use App\Model\TicketStatus;



final class InMemoryTicketCatalog implements TicketCatalogInterface{
    private array $tickets;

    public function __construct(){
       /* $this->tickets = [
            new Ticket(
                code: 'INC-1001',
                title: 'Error en la factura',
                priority: TicketPriority::Urgent,
                description:'Al imprimir salta un error en la factura',
                user:'Galimatias33',
                date: new \DateTime('05/02/2026'),
                status: TicketStatus::Progress,
            ),
            new Ticket(
                code: 'INC-1002',
                title: 'PC no enciednde',
                priority: TicketPriority::High,
                description:'Al imprimir salta un error en la factura',
                user:'Galimatias02',
                date: new \DateTime('05/02/2026'),
                status: TicketStatus::Close,
            ),
            new Ticket(
                code: 'INC-1003',
                title: 'Error en la factura',
                priority: TicketPriority::Normal,
                description:'Al imprimir salta un error en la factura',
                user:'Galimatias18',
                date: new \DateTime('05/02/2026'),
                status: TicketStatus::Open,
            )
  
        ];*/
    }

    /* all() retorna el listado de los tickets */
    public function all(): array {
        return $this->tickets;
    }
    /* findByCode() retorna un ticket dado su $code o null
    si no existe */
    public function findByCode(string $code): ?Ticket {
        return array_find(
            $this->tickets,
            fn (Ticket $ticket): bool => $ticket->getCode() === $code // Función flecha
        );
    }
}
