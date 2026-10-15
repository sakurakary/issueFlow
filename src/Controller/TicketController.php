<?php

declare(strict_types=1);

namespace App\Controller;

use ticket\models\Ticket;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class TicketController extends AbstractController
{
    /* En este ejemplo, los tickets se definen de forma estática. 
        En un caso real, se obtendrían de una base de datos. */

    /* TICKETS es un array donde cada elemento es un ticket en particular
    Cada ticket es un array asociativo, que contiene los datos o propiedades de este. */
    // Esto es una constante de clase, que se puede acceder desde cualquier método de la clase TicketController.


    #[Route('/tickets', name: 'app_ticket_index', methods: ['GET'])]
    // El método que devuelve la lista de tickets por convención REST es index().
    public function index(): Response {
        
        return $this->render('tickets/index.html.twig', [
            'title' => 'Incidencias',
            'tickets' => Ticket::getAllticket(),
        ]);

        //Esto sería para no usar plantilla twig, y generar el html directamente en el controlador, pero no es recomendable, por eso lo comentamos
        // Se inicializa la variable $html que contendrá el HTML de la página.
        //$html = '';
    // Se inicializan las variables $items, $title y $total que contendrán los <li> de cada incidencia, el título y el total respectivamente.
        $items = '';
        $title = 'Incidencias';
        // self::TICKETS hace referencia a la constante de clase TICKETS, que contiene el array de incidencias.
        $total = count(self::TICKETS);


        /*ya no necesitamos el foreach aqui por que lo hacemos en la plantilla      
        foreach (self::TICKETS as $ticket) {
            $items .= "<li>{$ticket['id']}: {$ticket['title']} ({$ticket['priority']})</li>";
        }
        /*
        Esto es lo que sucede en cada iteración del bucle foreach:
        Inicialmente,
        $items = '';
        Primer ticket del ciclo foreach:
        $items = '<li>INC-1001: No puedo iniciar sesión (urgent)</li>';
        Segundo ticket del ciclo foreach:
        $items = '<li>INC-1001: No puedo iniciar sesión (urgent)</li><li>INC-1002: Error en la factura (high)</li>';
        Tercer ticket del ciclo foreach:
        $items = '<li>INC-1001: No puedo iniciar sesión (urgent)</li><li>INC-1002: Error en la factura (high)</li><li>INC-1003: Actualizar datos de contacto (normal)</li>'    
        */

       

        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>{$title}</title>
            </head>
            <body>
                <h1>{$title}</h1>
                <p>Total de incidencias: {$total}</p>
                <ul>
                    {$items}
                </ul>
                <p><a href="/">Volver a la página principal</a></p>
            </body>
            </html>
        HTML;

        return new Response($html, Response::HTTP_OK); #}



    }

    // Ruta dinámica para mostrar un ticket específico por su ID.
    #[Route('/tickets/{id}', name:"app_ticket_show", methods: ['GET'])]
    // El método que devuelve un ticket en particular por convención REST es show().
    public function show(string $id/*, Request $request*/) {

        /*tambien se puede también recorrer el array, en vez de con foreach, con la función 
        array_find($array, $callback) 
        que devuelve el primer elemento del array que cumpla con la condición del callbacks 
        (desde PHP 8.4)*/

        $ticket = array_find
        (
            self::TICKETS, 
            fn(array $ticket):bool => $ticket['id'] === $id
        );
        
        /*
            si entra en el if lanza (return) que hay un error y se termina la función
            si no entra la función sigue y seguiria haciendo lo que hubiese
        */
        if ($ticket === null) {
            throw $this->createNotFoundException("Ticket con ID {$id} no encontrado.");
        }

        /**/
        return $this->render('tickets/show.html.twig', [
            'ticket' => $ticket
        ]);
    }
}