<?php

declare(strict_types=1);

namespace App\Controller;

//respuestas del servidor al cliente (200, 400, 500, etc)
use Symfony\Component\HttpFoundation\Response; 

//esta clase deja definir rutas para el controlador
use Symfony\Component\Routing\Attribute\Route;

//esta clase (final, que no se puede extender) define el controlador que estamos creando
final class HomeController
{
    //empezamos a definir las rutas que este controlador va a atender, en este caso la ruta raíz del sitio web ("/") y le damos un nombre a la ruta ("inicio") y le decimos que métodos va a atender, get, post, put, delete, etc. En este caso solo get
    #[Route('/', name: 'inicio', methods: ['GET'])]

    //funcion que se ejecuta al entrar a la ruta definida arriba, en este caso la ruta raíz del sitio web ("/")
    //se pone con : Response para indicar que esta función va a devolver un objeto de tipo Response, que es la respuesta del servidor al cliente
    public function index(): Response
{
        $projectName = "issueFlow";
        $message = "Symfony ha recibido la petición y a devuelto un Response";
        //para asignar un string a una variable, se puede usar <<<HTML para indicar que lo que sigue es un string que puede ocupar varias líneas y se cierra con HTML; al final de la línea, no debe haber ningún espacio ni tabulación
        $html = <<<HTML
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="{$projectName}">
                <title>{$projectName}</title>
            </head>
            <body>
                <h1>{$projectName}</h1>
                <p>{$message}</p>
                <p><a href="/tickets">Ver incidencias</a></p>
                <p><a href="/health">Comprobar estado</a></p>
            </body>
            </html>
        HTML;   
        //se devuelve un objeto de tipo Response, que es la respuesta del servidor al cliente, con el contenido HTML generado arriba, el código de estado HTTP 200 (OK) y el tipo de contenido (Content-Type) como text/html
        return new Response(
            $html,
            Response::HTTP_OK,
            ['Content-Type' => 'text/html']
        );
    }
    //aqui ahora se podrían poner más rutas para este controlador, por ejemplo, para manejar la ruta /tickets o /health, pero eso se haría en otros controladores, siguiendo el principio de responsabilidad única (SRP) de SOLID, que dice que cada clase debe tener una única responsabilidad y no mezclar responsabilidades en una misma clase.
}