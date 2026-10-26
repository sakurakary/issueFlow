<?php

declare(strict_types= 1);

namespace App\Tests\Service;

use App\Entity\Ticket;
use App\Model\TicketPriority;
use App\Model\TicketStatus;
use App\Service\TicketSlaCalculator;
use DateTime;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class TicketSlaCalculatorTest extends TestCase
{
    /*creamos el proveedor de datos para hacer el test*/
    public static function priorityProvider(): iterable
    {
        /* yield emite cada uno de los casos. es recomendable llamarlo como lo que va a devolver*/
        yield 'urgent' => [TicketPriority::Urgent, 4];
        yield 'high' => [TicketPriority::High, 8];
        yield 'normal' => [TicketPriority::Normal, 24];
        yield 'low' => [TicketPriority::Low, 72];
    }

    #[Test]
    #[DataProvider('priorityProvider')]

    public function it_calculates_the_response_target_for_each_priority(
        TicketPriority $priority,
        int $expectedHours
    ): void 
    {
        /*
            Creo un ticket para la prueba del cálculo de horas según la prioridad
        */
        $ticket = new Ticket(
            code:'INC-2001',
            title: 'Incidencia de prueba',
            priority: $priority,
            user:'pepe21',
            description:'EEs una ticket para hacer un test de TicketSlaCalculator',
            date: new DateTime('05/05/05'),
            status: TicketStatus::Open,
        );

        /*
            Instancio un TicketSlaCalculator para poder llamar al método getResponseTargetHours()
        */
        $calculator = new TicketSlaCalculator();

        /*
            Calculo la cantidad de horas correspondientes al ticeket usando el método getResponseTargetHours($ticket)
        */
        $hours = $calculator->getResponseTargetHours($ticket);

        /*
            Compruebo si las horas calculadas son iguales al valor esperado
        */
        self::assertSame($expectedHours, $hours);
    }
}
