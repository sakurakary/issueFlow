<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Ticket;
use App\Model\TicketPriority;
use App\Model\TicketStatus;


final class TicketCatalog{
    private array $tickets;

    public function __construct(){
        $this->tickets = [
            new Ticket(
                id: 'INC-1001',
                title: 'Error en la factura',
                priority: TicketPriority::Urgent,
                description:'Al imprimir salta un error en la factura',
                user:'Galimatias33',
                date: new \DateTime('05/02/2026'),
                status: TicketStatus::Progress,
            ),
            new Ticket(
                id: 'INC-1002',
                title: 'PC no enciednde',
                priority: TicketPriority::High,
                description:'Al imprimir salta un error en la factura',
                user:'Galimatias02',
                date: new \DateTime('05/02/2026'),
                status: TicketStatus::Close,
            ),
            new Ticket(
                id: 'INC-1003',
                title: 'Error en la factura',
                priority: TicketPriority::Normal,
                description:'Al imprimir salta un error en la factura',
                user:'Galimatias18',
                date: new \DateTime('05/02/2026'),
                status: TicketStatus::Open,
            )
  
        ];
    }

    /* all() retorna el listado de los tickets */
    public function all(): array {
        return $this->tickets;
    }
    /* find() retorna un ticket dado su $id o null
    si no existe */
    public function find(string $id): ?Ticket {
        return array_find(
            $this->tickets,
            fn (Ticket $ticket): bool => $ticket->getId() === $id // Función flecha
        );
    }
}
