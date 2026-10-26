<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\TicketPriority;
use App\Entity\Ticket;


//Crear un servicio que se encargue de asignar a los distintos tipos de priority de un ticket un tiempo de rrespuesta en horas de la siguiente manera: Urgent 4h, high 8h, normal 24h, low 72h

final class TicketSlaCalculator{

    public function getResponseTargetHours (Ticket $ticket): int{
   
        return match ($ticket->getPriority()) {
            TicketPriority::Urgent => 4,
            TicketPriority::High => 8,
            TicketPriority::Normal => 24,
            TicketPriority::Low => 72,
        };
    }
}