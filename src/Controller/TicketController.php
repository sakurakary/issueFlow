<?php

declare(strict_types=1);

namespace App\Controller;

use App\Contract\TicketCatalogInterface;
use App\Service\TicketSlaCalculator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

final class TicketController extends AbstractController
{
    /*Inyeccion de dependencias
    en el contructor de la clase creo una instancia del servicio a usar, en este caso TicketCatalog 
    en este caso llama al constructor de ese servicio creando la instancia automáticamente con toda las variables
    métodos, teniendo disponible la instancia en todos lados del controlador */
    public function __construct(
        private readonly TicketCatalogInterface $ticketCatalog,
        private readonly TicketSlaCalculator $ticketSlaCalculator,
    ){}

    #[Route('/tickets', name: 'app_ticket_index', methods: ['GET'])]
    // El método que devuelve la lista de tickets por convención REST es index().
    public function index(): Response {

        return $this->render('tickets/index.html.twig', [
            'title' => 'Incidencias',
            'tickets' => $this->ticketCatalog->all(),
        ]);

    }

    // Ruta dinámica para mostrar un ticket específico por su ID.
    #[Route('/tickets/{id}', name:"app_ticket_show", methods: ['GET'])]
    // El método que devuelve un ticket en particular por convención REST es show().
    public function show(string $id/*, Request $request*/) {

        

        $ticket = $this->ticketCatalog->find($id);
        
        /*
            si entra en el if lanza (return) que hay un error y se termina la función
            si no entra la función sigue y seguiria haciendo lo que hubiese
        */
        if ($ticket === null) {
            throw $this->createNotFoundException("Ticket con ID {$id} no encontrado.");
        }

        /**/
        return $this->render('tickets/show.html.twig', [
            'ticket' => $ticket,
            'responseTargetHours' => $this -> ticketSlaCalculator->getResponseTargetHours($ticket),
        ]);
    }
}