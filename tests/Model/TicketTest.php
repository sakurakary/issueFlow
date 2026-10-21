<?php

declare(strict_types= 1);

namespace App\Tests\Model;

use App\Model\TicketPriority;
use App\Model\TicketStatus;
use App\Model\Ticket;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Test;
use InvalidArgumentException;

final class TicketTest extends TestCase
{

    /*
        Puedo realizar varios test unitatios para la clase Ticket
        En general un test unitario tiene la siguiente estructura:
            - Arrage - ¿Qué necesito preparar? o contexto del test
            - Act - ¿Qué comportamiento ejecuto? La prueba que se va a hacer
            - Assert - ¿Qué resultado espero obtener?
    */
    
    #[Test]
    public function it_normalizes_a_title_when_the_ticket_is_created(): void
    {
        $ticket = new Ticket(
            id: "INC-1004",
            title:"     No puede iniciar sesión     ",
            priority: TicketPriority::Urgent,
            user:"CpVilla",
            description:"Al iniciar la sesión se queda congelado en el escritorio",
            date: new \DateTime('05/05/05'),
            status: TicketStatus::Open,
        );
        /*
            Probamos si normaliza los títulos quitando los espacios de alante y atrás que hay en en Tickets.php usando el trim(), con assertSame primero ponemos lo que esperamos obtener y que hay que ejecutar para hacer la prueba
        */
        $this->assertSame('No puede iniciar sesión', $ticket->getTitle());
    }

    #[Test]
    public function it_rejects_an_invalid_identifier():void
    {
        $this->expectException(InvalidArgumentException::class);
        new Ticket(
            id:'Ticket0001',
            title:'Incidencia válida',
            priority: TicketPriority::Urgent,
            user:"CpVilla",
            description:"Al iniciar la sesión se queda congelado en el escritorio",
            date: new \DateTime('05/05/05'),
            status: TicketStatus::Open,
        );

    }

    #[Test]
    public function it_rejects_empty_title():void
    {
        $this->expectException(InvalidArgumentException::class);
        new Ticket(
            id:'INC-1001',
            title:'',
            priority: TicketPriority::Urgent,
            user:"CpVilla",
            description:"Al iniciar la sesión se queda congelado en el escritorio",
            date: new \DateTime('05/05/05'),
            status: TicketStatus::Open,
        );

    }

    #[Test]
    public function it_reports_when_a_ticket_is_urgent(): void
    {

        $ticket = new Ticket(
            id:'INC-1001',
            title:'Todo vamos pasando',
            priority: TicketPriority::Urgent,
            user:'Pepi',
            description:'Vamos avanzando con los tests ok',
            date: new \DateTime('05/05/05'),
            status: TicketStatus::Open
        );

        $this->assertTrue($ticket->isUrgent());

    }
}


/*
    TDD: Test Driven Development
    Para una implementación:
    1º: Escribo los tests: me van a servir como un listado de las funcionalidades de lo que quiero implementar. Me dicen como debe funcionar mi implementación para los distintos casos posibles. Este es el momento de imaginarme todos los escenarios posibles. En principio todos los test van a resultar en Fallas: están todos en rojo.
    2º: Escribo el código mímimo (calidad de código) que haga pasar los tests: los test van a estar todos en verde.
    3º: Refactor: ejoras del código para que tenga mejor calidad.
    4º: tiene que estar todo en verde y el código optimizado




    Red → Green → Refactor
    Red: la prueba falla
    Green: la prueba pasa
    Refactor: mejoras el código sin romper la prueba

    ejemplo - Historia de usuario:
    Como usuario, quiero ver la lista de tickets.
    TDD:
        1. Prueba (falla):  
        2. “El servicio debe devolver una lista de tickets.”
        3. Código mínimo:  
        4. Implementas el servicio para devolver una lista vacía o mock.
        5. Prueba pasa:  
        6. La prueba ya no falla.
        7. Refactor:  
        8. Mejoras el servicio, agregas validaciones, etc.
        9. Nueva prueba:  
        10. “Debe devolver tickets ordenados por fecha.”
        11. Repite el ciclo.

*/